<?php
$ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269") 
or die("Could not connect to LDAP server.");

$basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";

$uname = 'jsimpson1271';
$password ='tucker24';
$user ="time-inc-corp\\".$uname"";
$ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269")
	or die("Could not connect to LDAP server.");

	if (!$ds){
	echo "wrong";
	}


	$dsb = ldap_bind($ds, $user, $password); 
	
?>


