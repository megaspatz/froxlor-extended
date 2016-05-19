<?php
if (! defined('MASTER_CRONJOB'))
	die('You cannot access this file directly!');

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2016 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright (c) the authors
 * @author Florian Aders <kontakt-froxlor@neteraser.de>
 * @author Froxlor team <team@froxlor.org> (2016-)
 * @license GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package Cron
 *
 * @since 0.9.35
 *
 */

$cronlog->logAction(CRON_ACTION, LOG_INFO, "Updating Let's Encrypt certificates");

if (! extension_loaded('curl')) {
	$cronlog->logAction(CRON_ACTION, LOG_ERR, "Let's Encrypt requires the php cURL extension to be installed.");
	exit();
}

$certificates_stmt = Database::query(
	"
		SELECT
			domssl.`id`,
			domssl.`domainid`,
			domssl.expirationdate,
			domssl.`ssl_cert_file`,
			domssl.`ssl_key_file`,
			domssl.`ssl_ca_file`,
			domssl.`ssl_csr_file`,
			dom.`domain`,
			dom.`wwwserveralias`,
			dom.`documentroot`,
			dom.`id` AS 'domainid',
			dom.`ssl_redirect`,
			cust.`leprivatekey`,
			cust.`lepublickey`,
			cust.`customerid`,
			cust.`loginname`
		FROM
			`" . TABLE_PANEL_CUSTOMERS . "` AS cust,
			`" . TABLE_PANEL_DOMAINS . "` AS dom
		LEFT JOIN
			`" . TABLE_PANEL_DOMAIN_SSL_SETTINGS . "` AS domssl ON
				dom.`id` = domssl.`domainid`
		WHERE
			dom.`customerid` = cust.`customerid`
			AND dom.`letsencrypt` = 1
			AND dom.`aliasdomain` IS NULL
			AND dom.`iswildcarddomain` = 0
			AND (
				domssl.`expirationdate` < DATE_ADD(NOW(), INTERVAL 30 DAY)
				OR domssl.`expirationdate` IS NULL
			)
	");

$aliasdomains_stmt = Database::prepare(
	"
		SELECT
			dom.`id` as domainid,
			dom.`domain`,
			dom.`wwwserveralias`
		FROM `" . TABLE_PANEL_DOMAINS . "` AS dom
		WHERE
			dom.`aliasdomain` = :id
			AND dom.`letsencrypt` = 1
			AND dom.`iswildcarddomain` = 0
	");

$updcert_stmt = Database::prepare(
	"
		REPLACE INTO
			`" . TABLE_PANEL_DOMAIN_SSL_SETTINGS . "`
		SET
			`id` = :id,
			`domainid` = :domainid,
			`ssl_cert_file` = :crt,
			`ssl_key_file` = :key,
			`ssl_ca_file` = :ca,
			`ssl_cert_chainfile` = :chain,
			`ssl_csr_file` = :csr,
			`expirationdate` = :expirationdate
	");

$upddom_stmt = Database::prepare("UPDATE `" . TABLE_PANEL_DOMAINS . "` SET `ssl_redirect` = '1' WHERE `id` = :domainid");

$changedetected = 0;
$certrows = $certificates_stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($certrows as $certrow) {

	// set logger to corresponding loginname for the log to appear in the users system-log
	$cronlog = FroxlorLogger::getInstanceOf(array(
		'loginname' => $certrow['loginname']
	));

	// Only renew let's encrypt certificate if no broken ssl_redirect is enabled
	if ($certrow['ssl_redirect'] != 2) {
		$cronlog->logAction(CRON_ACTION, LOG_DEBUG, "Updating " . $certrow['domain']);

		$cronlog->logAction(CRON_ACTION, LOG_DEBUG, "Adding SAN entry: " . $certrow['domain']);
		$domains = array(
			$certrow['domain']
		);
		// add www.<domain> to SAN list
		if ($certrow['wwwserveralias'] == 1) {
			$cronlog->logAction(CRON_ACTION, LOG_DEBUG, "Adding SAN entry: www." . $certrow['domain']);
			$domains[] = 'www.' . $certrow['domain'];
		}

		// add alias domains (and possibly www.<aliasdomain>) to SAN list
		Database::pexecute($aliasdomains_stmt, array(
			'id' => $certrow['domainid']
		));
		$aliasdomains = $aliasdomains_stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($aliasdomains as $aliasdomain) {
			$cronlog->logAction(CRON_ACTION, LOG_DEBUG, "Adding SAN entry: " . $aliasdomain['domain']);
			$domains[] = $aliasdomain['domain'];
			if ($aliasdomain['wwwserveralias'] == 1) {
				$cronlog->logAction(CRON_ACTION, LOG_DEBUG, "Adding SAN entry: www." . $aliasdomain['domain']);
				$domains[] = 'www.' . $aliasdomain['domain'];
			}
		}

		try {
			// Initialize Lescript with documentroot
			$le = new lescript($cronlog);

			// Initialize Lescript
			$le->initAccount($certrow);

			// Request the new certificate (old key may be used)
			$return = $le->signDomains($domains, $certrow['ssl_key_file'], $certrow['ssl_csr_file']);

			// We are interessted in the expirationdate
			$newcert = openssl_x509_parse($return['crt']);

			// Store the new data
			Database::pexecute($updcert_stmt,
				array(
					'id' => $certrow['id'],
					'domainid' => $certrow['domainid'],
					'crt' => $return['crt'],
					'key' => $return['key'],
					'ca' => $return['chain'],
					'chain' => $return['chain'],
					'csr' => $return['csr'],
					'expirationdate' => date('Y-m-d H:i:s', $newcert['validTo_time_t'])
				));

			if ($certrow['ssl_redirect'] == 3) {
				Database::pexecute($upddom_stmt, array(
					'domainid' => $certrow['domainid']
				));
			}

			$cronlog->logAction(CRON_ACTION, LOG_INFO, "Updated Let's Encrypt certificate for " . $certrow['domain']);

			$changedetected = 1;
		} catch (Exception $e) {
			$cronlog->logAction(CRON_ACTION, LOG_ERR,
				"Could not get Let's Encrypt certificate for " . $certrow['domain'] . ": " . $e->getMessage());
		}
	} else {
		$cronlog->logAction(CRON_ACTION, LOG_WARNING,
			"Skipping Let's Encrypt generation for " . $certrow['domain'] . " due to an enabled ssl_redirect");
	}
}

// If we have a change in a certificate, we need to update the webserver - configs
// This is easiest done by just creating a new task ;)
if ($changedetected) {
	inserttask(1);
}

// reset logger
$cronlog = FroxlorLogger::getInstanceOf(array(
	'loginname' => 'cronjob'
));
$cronlog->logAction(CRON_ACTION, LOG_INFO, "Let's Encrypt certificates have been updated");
