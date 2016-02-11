<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2010 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Froxlor team <team@froxlor.org> (2010-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    Formfields
 *
 */

return array(
	'vhostconfig_add' => array(
		'title' => $lng['admin']['vhostsettings']['addsettings'],
		'image' => 'icons/vhostsettings_add.png',
		'sections' => array(
			'section_a' => array(
				'title' => $lng['admin']['vhostsettings']['addnew'],
				'image' => 'icons/vhostsettings_add.png',
				'fields' => array(
					'description' => array(
						'label' => $lng['admin']['phpsettings']['description'],
						'type' => 'text',
						'maxlength' => 50
					),
					'vhostsettings' => array(
						'style' => 'align-top',
						'label' => $lng['admin']['vhostsettings']['vhostsettings'],
						'type' => 'textarea',
						'cols' => 100,
						'rows' => 30
					)
				)
			)
		)
	)
);
