<?php

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
 * @package    ext-dns
 *
 * See http://www.iana.org/assignments/dns-parameters/dns-parameters.xhtml
 * 
 */

// TYPE values

define('TYPE_A ',1);
define('TYPE_NS ',2);
define('TYPE_MD ',3);
define('TYPE_MF ',4);
define('TYPE_CNAME ',5);
define('TYPE_SOA ',6);
define('TYPE_MB ',7);
define('TYPE_MG ',8);
define('TYPE_MR ',9);
define('TYPE_NULL ',10);
define('TYPE_WKS ',11);
define('TYPE_PTR ',12);
define('TYPE_HINFO ',13);
define('TYPE_MINFO ',14);
define('TYPE_MX ',15);
define('TYPE_TXT ',16);
define('TYPE_RP ',17);
define('TYPE_AFSDB ',18);
define('TYPE_X25 ',19);
define('TYPE_ISDN ',20);
define('TYPE_RT ',21);
define('TYPE_NSAP ',22);
define('TYPE_NSAP-PTR ',23);
define('TYPE_SIG ',24);
define('TYPE_KEY ',25);
define('TYPE_PX ',26);
define('TYPE_GPOS ',27);
define('TYPE_AAAA ',28);
define('TYPE_LOC ',29);
define('TYPE_NXT ',30);
define('TYPE_EID ',31);
define('TYPE_NIMLOC ',32);
define('TYPE_SRV ',33);
define('TYPE_ATMA ',34);
define('TYPE_NAPTR ',35);
define('TYPE_KX ',36);
define('TYPE_CERT ',37);
define('TYPE_A6 ',38);
define('TYPE_DNAME ',39);
define('TYPE_SINK ',40);
define('TYPE_OPT ',41);
define('TYPE_APL ',42);
define('TYPE_DS ',43);
define('TYPE_SSHFP ',44);
define('TYPE_IPSECKEY ',45);
define('TYPE_RRSIG ',46);
define('TYPE_NSEC ',47);
define('TYPE_DNSKEY ',48);
define('TYPE_DHCID ',49);
define('TYPE_NSEC3 ',50);
define('TYPE_NSEC3PARAM ',51);
define('TYPE_TLSA ',52);
define('TYPE_SMIMEA ',53);
define('TYPE_Unassigned ',54);
define('TYPE_HIP ',55);
define('TYPE_NINFO ',56);
define('TYPE_RKEY ',57);
define('TYPE_TALINK ',58);
define('TYPE_CDS ',59);
define('TYPE_CDNSKEY ',60);
define('TYPE_OPENPGPKEY ',61);
define('TYPE_CSYNC ',62);
define('TYPE_Unassigned ',63-98 );
define('TYPE_SPF ',99);
define('TYPE_UINFO ',100);
define('TYPE_UID ',101);
define('TYPE_GID ',102);
define('TYPE_UNSPEC ',103);
define('TYPE_NID ',104);
define('TYPE_L32 ',105);
define('TYPE_L64 ',106);
define('TYPE_LP ',107);
define('TYPE_EUI48 ',108);
define('TYPE_EUI64 ',109);
define('TYPE_TKEY ',249);
define('TYPE_TSIG ',250);
define('TYPE_IXFR ',251);
define('TYPE_AXFR ',252);
define('TYPE_MAILB ',253);
define('TYPE_MAILA ',254);
define('TYPE_ANY', 255);
define('TYPE_URI ',256);
define('TYPE_CAA ',257);
define('TYPE_AVC ',258);
define('TYPE_TA ',32768);
define('TYPE_DLV ',32769);

// CLASS values (RFC 1035)
define('CLASS_IN', 1);
define('CLASS_CH', 3);
define('CLASS_HS', 4);
define('CLASS_NONE', 254);
define('CLASS_ANY', 255);



