<?php
   require_once('database.php');
   session_start();
   if ($_POST['step'] == 1)
       {
       $name      = $_POST['groupname'];
       $groupname = str_replace('/', ' ', $name);
       $name      = trim($groupname);
       $groupID   = mysql_query("Select * from groups WHERE name ='" . $name . "';");
       if ($row = mysql_fetch_array($groupID))
           {
           $_SESSION['GroupSuccess'] = false;
           $_SESSION['GroupAlert'] = true;
           header("Location: group");
           exit();
           }
       else
           {
            $_SESSION['GroupAlert'] = false;
           $_SESSION['GroupSuccess'] = true;
           $insert_sql = mysql_query("INSERT INTO groups (name) " . "VALUES ('{$name}');") or die(mysql_error());
           header("Location: group");
           exit();
           }
       }
   if ($_POST['step'] == 2)
       {
       $name      = $_REQUEST['groupdropdown'];
       $groupname = str_replace('/', ' ', $name);
       $event     = trim($groupname);
       $num2      = mysql_query("Select group_id from groups WHERE name ='" . $event . "';");
       while ($row1 = mysql_fetch_row($num2))
           {
           $group_id = $row1[0];
           }
       $check = mysql_query("Select repoID from repo_management WHERE groupID ='" . $event . "';");
       foreach ($_POST['user'] as $checkbox)
           {
           $userslash = $checkbox;
           $username  = str_replace('/', ' ', $userslash);
           $checkbox  = trim($username);
           $sql       = "Select user_id from user WHERE username ='" . $checkbox . "';";
           $check     = mysql_query($sql);
           while ($row1 = mysql_fetch_row($check))
               {
               $user_id = $row1[0];
               }
           $exists = mysql_query("Select * from group_management where groupID='" . $group_id . "' and userID='" . $user_id . "';");
           if ($row = mysql_fetch_array($exists))
               {
               $sql = "UPDATE group_management SET  time ='" . time() . "'
       WHERE groupID='" . $group_id . "' AND userID ='" . $user_id . "';";
               $check = mysql_query($sql) or die(mysql_error());
               }
           else
               {
               echo $user_id;
               $insert_sql = "INSERT INTO group_management (groupID, userID) " . "VALUES ('{$group_id}', '{$user_id}');";
               mysql_query($insert_sql) or die(mysql_error());
               }
           //Thinking about deleting from here down, because it doesn't make sense to alter, we just need to add if present and delete if not
           }
       header("Location: submitted");
       exit();
       }
   //Sent from the groups page, used to delete groups.
