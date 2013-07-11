<?php

	 $searchUser = "jsimpson1271";
   	 $searchPass = "tucker24";
  
   $ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269")
   	or die("Could not connect to LDAP server.");
   	
   $user ="time-inc-corp\\".$searchUser;
   $basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";
   
   $dsb = ldap_bind($ds, $user, $searchPass);
   
   
   $_SESSION['searchUser'] = $user;
   $_SESSION['searchPass'] = $searchPass;
   
   ?>