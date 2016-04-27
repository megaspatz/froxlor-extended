<?php if (!defined('MASTER_CRONJOB')) die('You cannot access this file directly!');

/**
 * This file is part of the Froxlor-Extended project.
 * Copyright (c) 2016 the Froxlor-Extended Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://froxlor.shsh.de/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Stefan Heid <stefan@shsh.de> (2016-)
 * @license    GPLv2 http://froxlor.shsh.de/COPYING.txt
 * @package    Cron
 *
 */

require_once makeCorrectFile(dirname(__FILE__) . '../../lib/classes/ext-dns/ext_dns_constants.php');

class ext_bind {
    
    public $logger = false;
    
    public function __construct($logger) {

		$this->logger = $logger;
                
                
    }
    
}