<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2003-2009 the SysCP Team (see authors).
 * Copyright (c) 2010 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Florian Lippert <flo@syscp.org> (2003-2009)
 * @author     Froxlor team <team@froxlor.org> (2010-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    Install
 *
 */

$updatelog = FroxlorLogger::getInstanceOf(array('loginname' => 'updater'), $settings);

$updatelogfile = validateUpdateLogFile(makeCorrectFile(dirname(__FILE__).'/update.log'));
$filelog = FileLogger::getInstanceOf(array('loginname' => 'updater'), $settings);
$filelog->setLogFile($updatelogfile);

// if first writing does not work we'll stop, tell the user to fix it
// and then let him try again.
try {
	$filelog->logAction(ADM_ACTION, LOG_WARNING, '-------------- START LOG --------------');
} catch(Exception $e) {
	standard_error('exception', $e->getMessage());
}

/*
 * since froxlor, we have to check if there's still someone
 * out there using syscp and needs to upgrade
 */
if(!isFroxlor()) {
	/**
	 * Upgrading SysCP to Froxlor-0.9
	 */
	include_once (makeCorrectFile(dirname(__FILE__).'/updates/froxlor/upgrade_syscp.inc.php'));
}

if (isFroxlor()) {
	include_once (makeCorrectFile(dirname(__FILE__).'/updates/froxlor/0.9/update_0.9.inc.php'));
	$filelog->logAction(ADM_ACTION, LOG_WARNING, '--------------- END LOG ---------------');
	unset($filelog);
}
