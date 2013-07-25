<?php
   require_once('database.php');
   require_once('ldap.php');
   session_start();
   //submitted from Show Step 1. Which is the dual view list of assigning users to groups
   //Purpose: To assign the relationship between users and groups.
   //1. Removes all association of that group
   //2. Checks for duplicate entries
   //3. Adds the users that are in the 2nd Dual View Box and creates an assocation in group_management
   //4. Redirects you back to the groups page upon completion
   if ($_POST['step'] == 1) {
       //gets the groupID, removes the slash, replaces it with a space, then removes the space.
       $groupname  = $_POST['groupname'];
       $groupslash = str_replace('/', ' ', $groupname);
       $groupname  = trim($groupslash);
       $groupcheck = mysql_query("SELECT group_id FROM groups WHERE NAME ='" . $groupname . "';");
       while ($row = mysql_fetch_row($groupcheck)) {
           $group_id = $row[0];
       }
       //if the 2nd box is empty we are to delete all association of users to that repo
       if (empty($_POST['box2View'])) {
           $clear = mysql_query("DELETE FROM group_management WHERE groupID ='" . $group_id . "';");
       } else {
           //to fix some bugs I automatically clear the entire list. So that way 
           //whenever you readd these users the ones you removed from the group
           //still won't have an entry. Only those who are left in the column.
           $clear = mysql_query("DELETE FROM group_management WHERE groupID ='" . $group_id . "';");
           foreach ($_POST['box2View'] as $selected) {
               //same fix for the slash problem.
               $username  = $selected;
               $user      = str_replace('/', ' ', $username);
               $username  = trim($user);
               $usercheck = mysql_query("SELECT user_id FROM user WHERE username ='" . $username . "';");
               while ($row = mysql_fetch_row($usercheck)) {
                   $user_id = $row[0];
               }
               $check = mysql_query("SELECT  * FROM group_management WHERE groupID ='" . $group_id . "' and userID='" . $user_id . "';");
               if (mysql_fetch_row($check)) {
                   //if there are 2 of the same users it will just update the time compenent (which is useless but solves the bug)
                   $timeUpdate = "UPDATE group_management SET  time ='" . time() . "'
                             								  WHERE groupID='" . $group_id . "' AND userID ='" . $user_id . "';";
                   mysql_query($timeUpdate) or die(mysql_error());
               } else {
                   //finally adds to group_manage the association between users and groups
                   $insert_sql = "INSERT INTO group_management (groupID, userID) " . "VALUES ('{$group_id}', '{$user_id}');";
                   mysql_query($insert_sql) or die(mysql_error());
               }
           }
       }
       header("Location: group");
       exit();
   } //End result, users are properly assigned to their groups in the group_mangement table
   //creates a new user. Sent from the create user page
   if ($_POST['step'] == 2) {
       $userType  = $_POST['userType'];
       $userslash = str_replace('/', ' ', $userType);
       $userType  = trim($userslash);
       if ($userType == 'user') {
           $manager = 0;
       } else {
           $manager = 1;
       }
       $uname = trim($_REQUEST['username']);
       $user  = "time-inc-corp\\" . $uname;
       $ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269") or die("Could not connect to LDAP server.");
       $basedn          = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";
       $logged_user     = $_SESSION['searchUser'];
       $logged_password = $_SESSION["searchPass"];
       $dsb             = ldap_bind($ds, $logged_user, $logged_password);
       // Search surname entry
       $filter          = "(sAMAccountName=" . $uname . ")";
       $justthese       = array(
           "sn",
           "sAMAccountName",
           "givenName",
           "mail",
           "cn"
       );
       $sr              = ldap_search($ds, $basedn, $filter, $justthese);
       $info            = ldap_get_entries($ds, $sr);
       if ($info["count"] === 0) {
           $_SESSION['Alert'] = true;
           header("Location: create");
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
           $tester       = mysql_query("Select username from user WHERE username ='" . $uname . "';");
           $num_results1 = mysql_num_rows($tester);
           if ($num_results1 == 0) {
               $insert_sql = "INSERT INTO user (username, first_name, " . "last_name, email, manager) " . "VALUES ('{$uname}', '{$firstName}', '{$lastName}', " . "'{$email}', '{$manager}');";
               mysql_query($insert_sql) or die(mysql_error());
               $num = mysql_query("Select user_id from user WHERE username ='" . $uname . "';");
               while ($row = mysql_fetch_row($num)) {
                   $user_id = $row[0];
               }
               $_SESSION['Alert']         = false;
               $_SESSION['CreateSuccess'] = true;
               header("Location: create");
               exit();
           } else {
               $_SESSION['Alert'] = true;
               header("Location: create");
               exit();
           }
       }
   }
   if ($_POST['step'] == 3) {
       $userName  = $_REQUEST['userName'];
       $userType  = $_POST['userType'];
       $userslash = str_replace('/', ' ', $userType);
       $userType  = trim($userslash);
       if ($userType == 'user') {
           $manager = 0;
       } else {
           $manager = 1;
       }
       $managerUpdate = "UPDATE user SET  manager ='" . $manager . "'
                             								  WHERE username='" . $userName . "';";
       mysql_query($managerUpdate) or die(mysql_error());
       $_SESSION['CreateSuccess'] = true;
       header('Location: create');
       exit();
   }
   if ($_POST['step'] == 4) {
       $userID       = $_REQUEST['userID'];
       $sshID        = $_REQUEST['sshID'];
       $delete_query = "DELETE FROM ssh_management WHERE userID ='" . $userID . "' and sshID = '" . $sshID . "';";
       mysql_query($delete_query) or die(mysql_error());
       $_SESSION['Success'] = True;
       header('Location: index');
       exit();
   }
   // Posted from create.html.php 
   // username value is passed into this function which deletes the user from the user list
   if ($_POST['step'] == 5) {
       $username     = $_REQUEST['username'];
       $delete_query = "DELETE FROM user WHERE username ='" . $username . "';";
       mysql_query($delete_query) or die(mysql_error());
       $_SESSION['CreateSuccess'] = true;
       header("Location: create");
       exit();
   }
   // updates SSH Key, sent from the index page
   if ($_POST['step'] == 6) {
       $ssh          = $_REQUEST['ssh'];
       $userID       = $_REQUEST['userID'];
       $insert_query = "UPDATE user SET ssh_key ='" . $ssh . "' WHERE user_id ='" . $userID . "';";
       mysql_query($insert_query) or die(mysql_error());
       header("Location: index");
       exit();
   }
   if ($_POST['step'] == 7) {
       $reponame = $_REQUEST['reponame'];
       $repotrim = trim($reponame);
       if (isset($_POST['repoType'])) {
           $repoType = $_POST['repoType'];
       } else {
           $_SESSION['RepoSuccess'] = false;
           $_SESSION['OptionAlert'] = true;
           header("Location: repo");
           exit();
       }
        $pattern = '/[^A-Za-z0-9\.\/\-\\\]/';
       if (preg_match($pattern, $repotrim)) {
           $_SESSION['RepoAlert'] = true;
           header("Location: repo");
           exit();
       }
       $reposlash = str_replace('/', ' ', $repoType);
       $repoType  = trim($reposlash);
       if ($repotrim == null) {
           $_SESSION['RepoAlert'] = true;
           header("Location: repo");
           exit();
       }
       if ($repoType == 'git') {
           $git = 1;
           $svn = 0;
       } else {
           $git = 0;
           $svn = 1;
       }
       $tester       = mysql_query("Select repo_id FROM repo WHERE name ='" . $reponame . "' AND git ='" . $git . "';");
       $num_results1 = mysql_num_rows($tester);
       if ($num_results1 == 0) {
           $insert_sql = "INSERT INTO repo (name, git, svn) " . "VALUES ('{$reponame}', '{$git}', '{$svn}');";
           //$insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
           mysql_query($insert_sql) or die(mysql_error());
           $_SESSION['RepoSuccess'] = true;
           $_SESSION['RepoAlert']   = false;
           $_SESSION['OptionAlert'] = false;
           header("Location: repo");
           exit();
       } else {
           $_SESSION['RepoSuccess'] = false;
           $_SESSION['RepoAlert']   = true;
           header("Location: repo");
           exit();
       }
   }
   if ($_POST['step'] == 8) {
       $groupname    = $_REQUEST['name'];
       $delete_query = "DELETE FROM groups WHERE name ='" . $groupname . "';";
       mysql_query($delete_query) or die(mysql_error());
       $_SESSION['GroupSuccess'] = true;
       header("Location: group");
       exit();
   }
   if ($_POST['step'] == 9) {
       $repoName     = $_REQUEST['name'];
       $delete_query = "DELETE FROM repo WHERE name ='" . $repoName . "';";
       mysql_query($delete_query) or die(mysql_error());
       $_SESSION['RepoSuccess'] = true;
       header("Location: repo");
       exit();
   }
   if ($_POST['step'] == 10) {
       if (isset($_POST['groupname'])) {
           $name      = $_POST['groupname'];
           
       } else {
           $_SESSION['GroupSuccess'] = false;
           $_SESSION['GroupAlert']   = true;
           header("Location: group");
           exit();
       }
       $groupname = str_replace('/', ' ', $name);
           $name      = trim($groupname);
       $pattern = '/[^A-Za-z0-9\.\/\-\\\]/';
       if (preg_match($pattern, $name)) {
           $_SESSION['GroupAlert'] = true;
           header("Location: group");
           exit();
       }
        if ($name == null) {
           $_SESSION['GroupAlert'] = true;
           header("Location: group");
           exit();
       }
       
       
       $groupID = mysql_query("Select * from groups WHERE name ='" . $name . "';");
       if ($row = mysql_fetch_array($groupID)) {
           $_SESSION['GroupSuccess'] = false;
           $_SESSION['GroupAlert']   = true;
           header("Location: group");
           exit();
       } else {
           $_SESSION['GroupAlert']   = false;
           $_SESSION['GroupSuccess'] = true;
           $insert_sql = mysql_query("INSERT INTO groups (name) " . "VALUES ('{$name}');") or die(mysql_error());
           header("Location: group");
           exit();
       }
   } else {
   }
   ?>
