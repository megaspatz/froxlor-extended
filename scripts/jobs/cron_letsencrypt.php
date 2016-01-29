<?php if (!defined('MASTER_CRONJOB')) die('You cannot access this file directly!');

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2016 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Florian Aders  <kontakt-froxlor@neteraser.de>
 * @author     Froxlor team <team@froxlor.org> (2016-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    Cron
 *
 * @since      0.9.35
 *
 */

fwrite($debugHandler, "updating let's encrypt certificates\n");

$certificates_stmt = Database::query("
	SELECT domssl.`id`, domssl.`ssl_cert_file`, domssl.`ssl_key_file`, domssl.`ssl_ca_file`, dom.`domain`, dom.`iswildcarddomain`, dom.`wwwserveralias`, dom.`documentroot`
	FROM `" . TABLE_PANEL_DOMAIN_SSL_SETTINGS . "` as domssl, `" . TABLE_PANEL_DOMAINS . "` as dom WHERE domssl.domainid = dom.id AND domssl.letsencrypt = 1
");

$upd_stmt = Database::prepare("
	UPDATE `".TABLE_PANEL_DOMAIN_SSL_SETTINGS."` SET `ssl_cert_file` = :crt, `ssl_key_file` = :key, `ssl_ca_file` = :ca, expirationdate = :expirationdate WHERE `id` = :id
");

while ($certrow = $certificates_stmt->fetch(PDO::FETCH_ASSOC)) {

	# Only renew let's encrypt certificate for domains where a documentroot
	# already exists
	if (file_exists($certrow['documentroot'])
		&& is_dir($certrow['documentroot'])
	) {
		fwrite($debugHandler, "updating " . $certrow['domain'] . "\n");
		# Parse the old certificate
		$x509data = openssl_x509_parse($certrow['ssl_cert_file']);
		
		# We are interessted in the old SAN - data
		$san = explode(', ', $x509data['extensions']['subjectAltName']);
		$domains = array();
		foreach($san as $dnsname) {
			$domains[] = substr($dnsname, 4);
		}
		
		try {
			# Initialize Lescript with documentroot
			$le = new lescript($certrow['documentroot'], $debugHandler);
			# Request the new certificate (old key may be used)
			$return = $le->signDomains($domains, $certrow['ssl_key_file']);
			
			# We are interessted in the expirationdate
			$newcert = openssl_x509_parse($return['crt']);
			
			# Store the new data
			Database::pexecute($upd_stmt, array(
					'crt' => $return['crt'],
					'key' => $return['key'],
					'ca' => $return['fullchain'],
					'expirationdate' => date('Y-m-d H:i:s', $newcert['validTo_time_t']),
					'id' => $certrow['id'])
			);
		} catch (\Exception $e) {
			fwrite($debugHandler, 'letsencrypt exception: ' . $e->getMessage());
		}
	} else {
		fwrite($debugHandler, 'documentroot ' . $certrow['documentroot'] . ' does not exist' . "\n");
	}
}
