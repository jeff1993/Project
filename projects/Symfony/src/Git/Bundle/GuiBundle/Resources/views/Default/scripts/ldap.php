<?php


 $newuser = $_COOKIE["TestUser"];
   $newpass = $_COOKIE["TestPass"];
   
   $ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269")
   	or die("Could not connect to LDAP server.");
   	
   
   $basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";
   
   $dsb = ldap_bind($ds, $newuser, $newpass);
   
   
   ?>