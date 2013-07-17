<?php
   require_once('scripts/database.php');
   require_once('scripts/ldap.php');
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
   }//End result, users are properly assigned to their groups in the group_mangement table
  
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
               $_SESSION['Alert'] = false;
               header("Location: create");
               exit();
           } else {
               $_SESSION['Alert'] = true;
               header("Location: create");
               exit();
           }
       }
   }
   //This is passed from Show Step 3. It is displayed under the the Groups to Repo
   //dual view list. 
   //Purpose:
   //Submits the changes  of the permisions of the groups to a specific repo
   //Checks each of the check boxes and passes them into this function
   //if checked marked in repo_management table as 1, if not a 0
   if ($_POST['step'] == 3) {
       //removes the slashes that are present in the repository name and the group name
       $reponame   = $_REQUEST['submitted'];
       $reposlash  = str_replace('/', ' ', $reponame);
       $reponame   = trim($reposlash);
       $groupname  = $_REQUEST['groupName'];
       $groupslash = str_replace('/', ' ', $groupname);
       $groupname  = trim($groupslash);
       $num2       = mysql_query("Select repo_id from repo WHERE name ='" . $reponame . "';");
       while ($row1 = mysql_fetch_row($num2)) {
           $repo_id = $row1[0];
       }
       $sql   = "Select group_id from groups WHERE name ='" . $groupname . "';";
       $check = mysql_query($sql);
       while ($row1 = mysql_fetch_row($check)) {
           $group_id = $row1[0];
           echo $group_id;
       }
       //read is always selected because there is no instance where you wouldn't want a group to be in the repo and not able to read
       $read   = 1;
       $write  = 0;
       $manage = 0;
       foreach ($_POST['checkbox'] as $checkbox) {
           if ($checkbox === "read") {
               $read = 1;
           }
           if ($checkbox === "write") {
               $write = 1;
           }
           if ($checkbox === "manage") {
               $manage = 1;
           }
           $exists = mysql_query("Select * from repo_management where groupID='" . $group_id . "' and repoID='" . $repo_id . "';");
           if ($row = mysql_fetch_array($exists)) {
               $sql = "UPDATE repo_management SET  perm_read ='" . $read . "',
         perm_write ='" . $write . "',
         perm_manage ='" . $manage . "'
          WHERE groupID='" . $group_id . "' AND repoID ='" . $repo_id . "';";
               $check = mysql_query($sql) or die(mysql_error());
           } else {
               echo $repo_id;
               $insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
               mysql_query($insert_sql) or die(mysql_error());
           }
       }
       header("Location: repo");
       exit();
   }
   //sent from the assigning groups to repos page, the dual list  
   if ($_POST['step'] == 4) {
       //gets the groupID, removes the slash, replaces it with a space, then removes the space.
       $repoName  = $_POST['repoName'];
       $reposlash = str_replace('/', ' ', $repoName);
       $repoName  = trim($reposlash);
       $repocheck = mysql_query("SELECT repo_id FROM repo WHERE name ='" . $repoName . "';");
       while ($row = mysql_fetch_row($repocheck)) {
           $repo_id = $row[0];
       }
       $clear = "DELETE FROM repo_management WHERE repoID ='" . $repo_id . "';";
       if (empty($_POST['box2View'])) {
           mysql_query($clear) or die(mysql_error());
       } else {
           mysql_query($clear) or die(mysql_error());
           foreach ($_POST['box2View'] as $selected) {
               $groupName  = $selected;
               $group      = str_replace('/', ' ', $groupName);
               $groupName  = trim($group);
               $getGroupID = mysql_query("SELECT group_id FROM groups WHERE name ='" . $groupName . "';");
               while ($row = mysql_fetch_row($getGroupID)) {
                   $group_id = $row[0];
               }
               while ($row = mysql_fetch_row($getGroupID)) {
                   $group_id = $row[0];
               }
               $check = mysql_query("SELECT  * FROM repo_management WHERE groupID ='" . $group_id . "' and repoID='" . $repo_id . "';");
               if (mysql_fetch_row($check)) {
                   $timeUpdate = "UPDATE repo_management SET  time ='" . time() . "'
          WHERE groupID='" . $group_id . "' AND repoID ='" . $repo_id . "';";
                   mysql_query($timeUpdate) or die(mysql_error());
               } else {
                   $insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
                   mysql_query($insert_sql) or die(mysql_error());
               }
           }
       }
       header("Location: repo");
       exit();
   }
   // Posted from create.html.php 
   // username value is passed into this function which deletes the user from the user list
   if ($_POST['step'] == 5) {
       foreach ($_POST['deleteBox'] as $checkbox) {
           $delete_query = "DELETE FROM user WHERE username ='" . $checkbox . "';";
           mysql_query($delete_query) or die(mysql_error());
       }
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
   //updates type of repository, sent from show 3
   if ($_POST['step'] == 7) {
       $repoName = $_REQUEST['repoName'];
       $repo     = trim($repoName);
       $type     = $_REQUEST['repoType'];
       if ($type == 'git') {
           $git = 1;
           $svn = 0;
       } else {
           $git = 0;
           $svn = 1;
       }
       $insert_query = "UPDATE repo SET git ='" . $git . "', svn ='" . $svn . "' WHERE name ='" . $repo . "';";
       mysql_query($insert_query) or die(mysql_error());
       header("Location: repo");
       exit();
   }
   ?>