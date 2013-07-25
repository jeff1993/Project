<?php
   session_start();
   require_once('database.php');
   $userName = trim($_REQUEST['username']);
   $password = $_REQUEST['password'];
   $user     = "time-inc-corp\\" . $userName;
   $ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269") or die("Could not connect to LDAP server.");
   setcookie("LoggedUser", $userName);
   $basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";
   if ($ds) {
       try {
           $dsb = ldap_bind($ds, $user, $password);
           if ($dsb) {
               $_SESSION['Alert']    = false;
               $_SESSION['LoggedIn'] = true;
               $manager_check        = mysql_query("SELECT manager FROM user WHERE username ='" . $userName . "';");
               while ($row = mysql_fetch_array($manager_check)) {
                   $manager = $row['manager'];
                   if ($manager == 1) {
                       $_SESSION['manager'] = true;
                   } else {
                       $_SESSION['manager'] = false;
                   }
                   header("Location: index");
                   exit();
               }
               if (mysql_fetch_row($manager_check) == 0) {
                   $logged_user         = $_SESSION['searchUser'];
                   $logged_password     = $_SESSION["searchPass"];
                   $_SESSION['manager'] = false;
                   // Search surname entry
                   $filter              = "(sAMAccountName=" . $userName . ")";
                   $justthese           = array(
                       "sn",
                       "sAMAccountName",
                       "givenName",
                       "mail",
                       "cn"
                   );
                   $sr                  = ldap_search($ds, $basedn, $filter, $justthese);
                   $info                = ldap_get_entries($ds, $sr);
                   if ($info["count"] === 0) {
                       $_SESSION['Alert'] = true;
                       header("Location: login");
                       exit();
                   } else if (!$sr) {
                       echo "<br/>failure <br/>";
                   } else {
                       $info = ldap_get_entries($ds, $sr);
                       for ($i = 0; $i < $info["count"]; $i++) {
                           $fullname  = $info[$i]["cn"][0];
                           $pieces    = explode(" ", $fullname);
                           $email     = $info[$i]["mail"][0];
                           $firstName = $pieces[0];
                           $lastName  = $pieces[1];
                       }
                       $manager    = 0;
                       $insert_sql = "INSERT INTO user (username, first_name, " . "last_name, email, manager) " . "VALUES ('{$userName}', '{$firstName}', '{$lastName}', " . "'{$email}', '{$manager}');";
                       mysql_query($insert_sql) or die(mysql_error());
                       $num = mysql_query("Select user_id from user WHERE username ='" . $userName . "';");
                       while ($row = mysql_fetch_row($num)) {
                           $user_id                   = $row[0];
                           $_SESSION['Alert']         = false;
                           $_SESSION['CreateSuccess'] = true;
                       }
                       if (mysql_fetch_row($num) == 0) {
                           $_SESSION['Alert'] = true;
                       }
                   }
               }
               header("Location: index");
               exit();
           }
       }
       catch (Exception $e) {
           $_SESSION['Alert'] = true;
           header("Location: login");
           exit();
           throw new Exception(' Something really gone wrong', 0, $e);
       }
   } else {
       $_SESSION['Alert']    = true;
       $_SESSION['LoggedIn'] = false;
       header("Location: login");
       exit();
   }
   ?>