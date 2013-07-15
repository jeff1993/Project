<?php
   session_start();
   require_once('scripts/database.php');
   $userName = trim($_REQUEST['username']);
   $password = $_REQUEST['password'];
   $user     = "time-inc-corp\\" . $userName;
   $ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269") or die("Could not connect to LDAP server.");
   setcookie("LoggedUser", $userName);
   $basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";
   
   if ($ds)
       {
       try
           {
           $dsb = ldap_bind($ds, $user, $password);
           if ($dsb)
               {
               $_SESSION['Alert']    = false;
               $_SESSION['LoggedIn'] = true;
              $manager_check= mysql_query("SELECT * FROM user WHERE username ='".$userName."';");
              while ($row = mysql_fetch_array($manager_check)){
               	$manager = $row['manager'];

               }
               if($manager ==1){
               
               $_SESSION['manager'] = true;

               }
               else {
               $_SESSION['manager'] = false;
               
               }
               header("Location: index");
               exit();
               }
           }
       catch (Exception $e)
           {
           $_SESSION['Alert'] = true;
           header("Location: login");
           exit();
           throw new Exception(' Something really gone wrong', 0, $e);
           }
       }
   else
       {
       $_SESSION['Alert']    = true;
       $_SESSION['LoggedIn'] = false;
       header("Location: login");
       exit();
       }
   ?>