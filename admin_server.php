<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2016 Stefan Heid
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at https://froxlor.shsh.de/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Stefan Heid <stefan@heid.ws> (2016-)
 * @license    GPLv2 https://froxlor.shsh.de/COPYING.txt
 * @package    Panel
 *
 */

define('AREA', 'admin');
require './lib/init.php';

if (isset($_POST['id'])) {
	$id = intval($_POST['id']);
} elseif(isset($_GET['id'])) {
	$id = intval($_GET['id']);
}

if ($page == 'server'
	&& $userinfo['change_serversettings'] == '1'
) {
    
}