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
 * @package    Settings
 *
 */

return array(
	'groups' => array(
		'nameserver' => array(
			'title' => $lng['admin']['nameserversettings'],
			'fields' => array(
				'nameserver_enable' => array(
					'label' => $lng['serversettings']['bindenable'],
					'settinggroup' => 'system',
					'varname' => 'bind_enable',
					'type' => 'bool',
					'default' => true,
					'save_method' => 'storeSettingField',
					'overview_option' => true
					),
				'system_dnsenabled' => array(
					'label' => $lng['serversettings']['dnseditorenable'],
					'settinggroup' => 'system',
					'varname' => 'dnsenabled',
					'type' => 'bool',
					'default' => false,
					'save_method' => 'storeSettingField'
					),
				'system_dns_server' => array(
					'label' => $lng['serversettings']['dns_server'],
					'settinggroup' => 'system',
					'varname' => 'dns_server',
					'type' => 'option',
					'default' => 'bind',
					'option_mode' => 'one',
					'option_options' => array('bind' => 'Bind9', 'pdns' => 'PowerDNS'),
					'save_method' => 'storeSettingField'
				),
				'system_bindconf_directory' => array(
					'label' => $lng['serversettings']['bindconf_directory'],
					'settinggroup' => 'system',
					'varname' => 'bindconf_directory',
					'type' => 'string',
					'string_type' => 'dir',
					'default' => '/etc/bind/',
					'save_method' => 'storeSettingField',
					),
                                'system_bindconf_zonefiles_directory' => array(
					'label' => $lng['serversettings']['bindconf_zonefiles_directory'],
					'settinggroup' => 'system',
					'varname' => 'bindconf_zonefiles_directory',
					'type' => 'string',
					'string_type' => 'dir',
					'default' => '/etc/bind/domains',
					'save_method' => 'storeSettingField',
					),
                                'system_bindconf_file' => array(
					'label' => $lng['serversettings']['bindconf_file'],
					'settinggroup' => 'system',
					'varname' => 'bindconf_file',
					'type' => 'string',
					'string_type' => 'dir',
					'default' => 'froxlor.conf',
					'save_method' => 'storeSettingField',
					),
				'system_bindreload_command' => array(
					'label' => $lng['serversettings']['bindreload_command'],
					'settinggroup' => 'system',
					'varname' => 'bindreload_command',
					'type' => 'string',
					'default' => '/etc/init.d/bind9 reload',
					'save_method' => 'storeSettingField',
					),
				'system_nameservers' => array(
					'label' => $lng['serversettings']['nameservers'],
					'settinggroup' => 'system',
					'varname' => 'nameservers',
					'type' => 'string',
					'string_regexp' => '/^(([a-z0-9\-\._]+, ?)*[a-z0-9\-\._]+)?$/i',
					'string_emptyallowed' => true,
					'default' => '',
					'save_method' => 'storeSettingFieldInsertBindTask',
					),
				'system_mxservers' => array(
					'label' => $lng['serversettings']['mxservers'],
					'settinggroup' => 'system',
					'varname' => 'mxservers',
					'type' => 'string',
					'string_regexp' => '/^(([0-9]+ [a-z0-9\-\._]+, ?)*[0-9]+ [a-z0-9\-\._]+)?$/i',
					'string_emptyallowed' => true,
					'default' => '',
					'save_method' => 'storeSettingField',
					),
				'system_axfrservers' => array(
					'label' => $lng['serversettings']['axfrservers'],
					'settinggroup' => 'system',
					'varname' => 'axfrservers',
					'type' => 'string',
					'string_type' => 'validate_ip_incl_private',
					'string_delimiter' => ',',
					'string_emptyallowed' => true,
					'default' => '',
					'save_method' => 'storeSettingField',
				),
				'system_dns_createhostnameentry' => array(
					'label' => $lng['serversettings']['dns_createhostnameentry'],
					'settinggroup' => 'system',
					'varname' => 'dns_createhostnameentry',
					'type' => 'bool',
					'default' => false,
					'save_method' => 'storeSettingField'
				),
				'system_dns_createmailentry' => array(
					'label' => $lng['serversettings']['mail_also_with_mxservers'],
					'settinggroup' => 'system',
					'varname' => 'dns_createmailentry',
					'type' => 'bool',
					'default' => false,
					'save_method' => 'storeSettingField'
					),
				'system_defaultttl' => array(
					'label' => $lng['serversettings']['defaultttl'],
					'settinggroup' => 'system',
					'varname' => 'defaultttl',
					'type' => 'int',
					'default' => 604800, /* 1 week */
					'int_min' => 180, /* 1 hour */
					'int_max' => 2147483647, /* integer max */
					'save_method' => 'storeSettingField',
					),
                                'system_default_soa_minserial' => array(
					'label' => $lng['serversettings']['default_soa_minserial'],
					'settinggroup' => 'system',
					'varname' => 'default_soa_minserial',
					'type' => 'int',
					'default' => 2016010100, 
					'int_min' => 2000000000, 
					'int_max' => 2147483647, /* integer max */
					'save_method' => 'storeSettingField',
					),
                                'system_default_soa_refresh' => array(
					'label' => $lng['serversettings']['default_soa_refresh'],
					'settinggroup' => 'system',
					'varname' => 'default_soa_refresh',
					'type' => 'int',
					'default' => 3600, 
					'int_min' => 180, 
					'int_max' => 2147483647, /* integer max */
					'save_method' => 'storeSettingField',
					),
                                'system_default_soa_retry' => array(
					'label' => $lng['serversettings']['default_soa_retry'],
					'settinggroup' => 'system',
					'varname' => 'default_soa_retry',
					'type' => 'int',
					'default' => 900, 
					'int_min' => 180, 
					'int_max' => 2147483647, /* integer max */
					'save_method' => 'storeSettingField',
					),
                                'system_default_soa_expire' => array(
					'label' => $lng['serversettings']['default_soa_expire'],
					'settinggroup' => 'system',
					'varname' => 'default_soa_expire',
					'type' => 'int',
					'default' => 1209600, 
					'int_min' => 180, 
					'int_max' => 2147483647, /* integer max */
					'save_method' => 'storeSettingField',
					),
                                'system_default_soa_minimum' => array(
					'label' => $lng['serversettings']['default_soa_minimum'],
					'settinggroup' => 'system',
					'varname' => 'default_soa_minimum',
					'type' => 'int',
					'default' => 86400, 
					'int_min' => 180, 
					'int_max' => 2147483647, /* integer max */
					'save_method' => 'storeSettingField',
					),
				),
			),
		),
	);

?>