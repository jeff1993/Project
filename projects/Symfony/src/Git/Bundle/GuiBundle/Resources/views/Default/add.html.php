<script>
   function myFunction()
   {
   alert("I am an alert box!"); // this is the message in ""
   }
</script>
<?php
   require_once('scripts/database.php');
   //removes user from group
   if ($_POST['step'] == 1) {
   
   	//gets the groupID, removes the slash, replaces it with a space, then removes the space.
   	$groupname      = $_POST['groupname'];
       $groupslash = str_replace('/', ' ', $groupname);
       $groupname      = trim($groupslash);
   
   	echo $groupname;
   	$groupcheck = mysql_query("SELECT group_id FROM groups WHERE NAME ='".$groupname."';");       
           while ($row = mysql_fetch_row($groupcheck)) {
               $group_id = $row[0];
          
           }
          
   
   	if (empty($_POST['box2View'])){
   	
   	$clear = mysql_query("DELETE FROM group_management WHERE groupID ='".$group_id."';");
   	
   	}
   	
   	else 
   	{
   		$clear = mysql_query("DELETE FROM group_management WHERE groupID ='".$group_id."';");
      foreach ($_POST['box2View'] as $selected) {
   
           $username  = $selected;
      		$user = str_replace('/', ' ', $username);
       	$username = trim($user);
       	 echo $username;
   		
   		$usercheck = mysql_query("SELECT user_id FROM user WHERE username ='".$username."';");       
           while ($row = mysql_fetch_row($usercheck)) {
               $user_id = $row[0];
          
           }
   		   	$check = mysql_query("SELECT  * FROM group_management WHERE groupID ='".$group_id."' and userID='".$user_id."';");       
   			if (mysql_fetch_row($check)){
   			
   			$timeUpdate = "UPDATE group_management SET  time ='" . time() . "'
    WHERE groupID='" . $group_id . "' AND repoID ='".$repo_id."';";
            mysql_query($timeUpdate) or die(mysql_error());
   			
   			}
   			
   			else {
   	
      		$insert_sql = "INSERT INTO group_management (groupID, userID) " . "VALUES ('{$group_id}', '{$user_id}');";
           
           mysql_query($insert_sql) or die(mysql_error());
      		
   }
   		}
   	}
   }
   
   
   
   //creates a new user
   if ($_POST['step'] == 2) {
   
   $uname = trim($_REQUEST['username']);
   $user  = "time-inc-corp\\" . $uname;
   
   
   $ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269") or die("Could not connect to LDAP server.");
   
   $basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";
   
   $logged_user     = $_COOKIE["LoggedUser"];
   $logged_password = $_COOKIE["LoggedPass"];
   
   $dsb = ldap_bind($ds, $logged_user, $logged_password);
   
   // Search surname entry
   $filter    = "(sAMAccountName=" . $uname . ")";
   $justthese = array(
       "sn",
       "sAMAccountName",
       "givenName",
       "mail",
       "cn"
   );
   $sr        = ldap_search($ds, $basedn, $filter, $justthese);
   $info      = ldap_get_entries($ds, $sr);
   
   if ($info["count"] === 0) {
       
       echo '<script type="text/javascript"> 
   
   if(confirm("You Have Entered an Incorrect UserName")) {
       window.location.href = "create"
   }
   </script>';
       
       
   } else if (!$sr) {
       
       echo "<br/>failure <br/>";
       
   }
   
   else {
       $info = ldap_get_entries($ds, $sr);
       
       
       
       
       for ($i = 0; $i < $info["count"]; $i++) {
           
           
           $fullname  = $info[$i]["cn"][0];
           $pieces    = explode(" ", $fullname);
           $email     = $info[$i]["mail"][0];
           $firstName = $pieces[0];
           $lastName  = $pieces[1];
           
       }
       
       
       
       
       $tester = mysql_query("Select username from user WHERE username ='" . $uname . "';");
       
       $num_results1 = mysql_num_rows($tester);
       
       if ($num_results1 == 0) {
           
           $insert_sql = "INSERT INTO user (username, first_name, " . "last_name, email) " . "VALUES ('{$uname}', '{$firstName}', '{$lastName}', " . "'{$email}');";
           
           mysql_query($insert_sql) or die(mysql_error());
           
           
           
           $num = mysql_query("Select user_id from user WHERE username ='" . $uname . "';");
           while ($row = mysql_fetch_row($num)) {
               $user_id = $row[0];
           }
           
           echo $user_id;
           
           
           header("Location: submitted");
           exit();
           
       }
       
       
       
       else {
     
               
               echo '<script type="text/javascript"> 
   
   if(confirm("This Username already exists")) {
       window.location.href = "create"
   }
   </script>';
               
               
           }
           
   
       }
   }
   
   
   
   
   if ($_POST['step'] == 3) {
   
   
   
   
     	$reponame     = $_REQUEST['submitted'];
       $reposlash = str_replace('/', ' ', $reponame);
       $reponame      = trim($reposlash);
        
       $groupname = $_REQUEST['groupName'];
       $groupslash = str_replace('/', ' ', $groupname);
       $groupname = trim($groupslash);
      
       
       $num2= mysql_query("Select repo_id from repo WHERE name ='".$reponame."';");
        while ($row1 = mysql_fetch_row($num2)) {
      		$repo_id=$row1[0];
       }
   
   	 $sql = "Select group_id from groups WHERE name ='" . $groupname . "';";
           $check  = mysql_query($sql);
       	
           while ($row1 = mysql_fetch_row($check)) {
      		$group_id=$row1[0];
      		echo $group_id;
      		}
   
   	//$check =mysql_query("Select repoID from repo_management WHERE groupID ='".$group_id."';");
   			$read =0;
      			$write=0;
      			$manage=0;
      			
      			
      			if (isset($_POST['Delete'])) {
     $delete_sql = "DELETE FROM repo_management WHERE groupID ='".$group_id."' and repoID ='".$repo_id."';";
           mysql_query($delete_sql) or die(mysql_error());
           
           header("Location: submitted");
           exit(); 
   }
   else {
       foreach ($_POST['checkbox'] as $checkbox) {
     
   
       	 echo $checkbox;
       	 echo $groupname;
       	 
          
      			
      		
      		 if ($checkbox === "read") {
               $read = 1;
               
           }
           if ($checkbox === "write") {
               $write = 1;
               
           }
           if ($checkbox === "manage") {
               $manage = 1;
               
           }
           
      		
   
      		
      		$exists =mysql_query("Select * from repo_management where groupID='".$group_id."' and repoID='".$repo_id."';");
      		
      		if($row =mysql_fetch_array($exists)){
   
   
      		 $sql = "UPDATE repo_management SET  perm_read ='" . $read . "',
   perm_write ='" . $write . "',
   perm_manage ='" . $manage . "'
    WHERE groupID='" . $group_id . "' AND repoID ='".$repo_id."';";
               $check = mysql_query($sql) or die(mysql_error());
      		
   
      		}
      		
      		else {
      		echo $repo_id;
      		
      		$insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
           
           mysql_query($insert_sql) or die(mysql_error());
      		
      		
      		echo "success";
      		
   
   		}
      			
      		
      		//Thinking about deleting from here down, because it doesn't make sense to alter, we just need to add if present and delete if not
      		
      		}
      		
      		echo " Alter success";  
   
   }
   }
   
    if ($_POST['step'] == 4) {
   
   	//gets the groupID, removes the slash, replaces it with a space, then removes the space.
   		$repoName      = $_POST['repoName'];
       $reposlash = str_replace('/', ' ', $repoName);
       $repoName      = trim($reposlash);
   
   	echo $repoName;
   	$repocheck = mysql_query("SELECT repo_id FROM repo WHERE name ='".$repoName."';");       
           while ($row = mysql_fetch_row($repocheck)) {
               $repo_id = $row[0];
          
           }
          
   	$clear = "DELETE FROM repo_management WHERE repoID ='".$repo_id."';";
   	if (empty($_POST['box2View'])){
   	
   
   	mysql_query($clear) or die(mysql_error());
   	
   	}
   	
   	else 
   	{
   	mysql_query($clear) or die(mysql_error());
      foreach ($_POST['box2View'] as $selected) {
   
           $groupName  = $selected;
      		$group = str_replace('/', ' ', $groupName);
       	$groupName = trim($group);
       	 echo $groupName;
   		
   		$getGroupID = mysql_query("SELECT group_id FROM groups WHERE name ='".$groupName."';");       
           while ($row = mysql_fetch_row($getGroupID)) {
               $group_id = $row[0];
          
           }
   		
   			
   			
           while ($row = mysql_fetch_row($getGroupID)) {
               $group_id = $row[0];
          
           }
   	$check = mysql_query("SELECT  * FROM repo_management WHERE groupID ='".$group_id."' and repoID='".$repo_id."';");       
   			if (mysql_fetch_row($check)){
   			
   			$timeUpdate = "UPDATE repo_management SET  time ='" . time() . "'
    WHERE groupID='" . $group_id . "' AND repoID ='".$repo_id."';";
            mysql_query($timeUpdate) or die(mysql_error());
   			
   			}
   			
   			else {
   		
      		$insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
           
           mysql_query($insert_sql) or die(mysql_error());
      		
   }
   		}
   	}
   }
   
     if ($_POST['step'] == 5) {
     
      echo '<script type="text/javascript"> 
   
   if(confirm("You Have Entered an Incorrect UserName")) {
       window.location.href = "create"
   }
   </script>';
     
     
     
 
   
   
   
   }
   
   ?>