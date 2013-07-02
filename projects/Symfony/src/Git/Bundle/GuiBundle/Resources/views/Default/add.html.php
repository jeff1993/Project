<script>
function myFunction()
{
alert("I am an alert box!"); // this is the message in ""
}
</script>

<?php


mysql_connect("localhost", "root", "tucker24") or die("<p>Error connecting to database: " . mysql_error() . "</p>");

mysql_select_db("Test") or die("<p>Error selecting the database your-database-name: " . mysql_error() . "</p>");


//removes user from group
if ($_POST['step'] == 1) {
	
	//gets the groupID, removes the slash, replaces it with a space, then removes the space.
	$groupID      = $_POST['groupID'];
    $groupslash = str_replace('/', ' ', $groupID);
    $groupID      = trim($groupslash);
	
	
	//recieves the username that you want to delete.
	$username =$_REQUEST['username'];
	echo $username;
	
	$userQuery= mysql_query("Select user_id from user where username ='".$username."';");
	 while ($row = mysql_fetch_row($userQuery)) {
            $userID = $row[0];
        }
        
        $delete_sql = "DELETE FROM group_management WHERE groupID ='".$groupID."' and userID ='".$userID."';";
        mysql_query($delete_sql) or die(mysql_error());
        
        header("Location: submitted");
        exit(); 
        
	
}





//creates a new user
if ($_POST['step'] == 2) {

$uname = trim($_REQUEST['username']);
$user  = "time-inc-corp\\" . $uname;


$ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269") or die("Could not connect to LDAP server.");

$basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";

$logged_user     = $_COOKIE["TestUser"];
$logged_password = $_COOKIE["TestPass"];

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
        
        
        $event = $_POST["mydropdown"];
        
        $num2 = mysql_query("Select group_id from groups WHERE name ='" . $event . "';");
        while ($row1 = mysql_fetch_row($num2)) {
            $group_id = $row1[0];
        }
        
        
        $insert_sql = "INSERT INTO group_management (groupID, userID) " . "VALUES ('{$group_id}', '{$user_id}');";
        
        mysql_query($insert_sql) or die(mysql_error());
        
        header("Location: submitted");
        exit();
        
    }
    
    
    
    else {
        $num = mysql_query("Select user_id from user WHERE username ='" . $uname . "';");
        while ($row = mysql_fetch_row($num)) {
            $user_id = $row[0];
        }
        
        
        
        
        $event = $_POST["mydropdown"];
        echo $event;
        $num2 = mysql_query("Select group_id from groups WHERE name ='" . $event . "';");
        while ($row1 = mysql_fetch_row($num2)) {
            $group_id = $row1[0];
            
        }
        
        $sql = "SELECT * FROM group_management WHERE groupID=" . $group_id . " AND userID=" . $user_id . " LIMIT 0, 30 ;";
        
        $check = mysql_query($sql);
        
        $row         = mysql_fetch_array($check);
        $num_results = mysql_num_rows($check);
        
        if ($num_results > 0) {
            
            echo '<script type="text/javascript"> 

if(confirm("This Username already exists")) {
    window.location.href = "create"
}
</script>';
            
            
        }
        
        else {
            
            $insert_sql = "INSERT INTO group_management (groupID, userID) " . "VALUES ('{$group_id}', '{$user_id}');";
            
            mysql_query($insert_sql) or die(mysql_error());
            header("Location: submitted");
            exit();
        }
        
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
	
	
	//$check =mysql_query("Select repoID from repo_management WHERE groupID ='".$group_id."';");
			$read =0;
   			$write=0;
   			$manage=0;
    foreach ($_POST['checkbox'] as $checkbox) {
  

    	 echo $checkbox;
    	 echo $groupname;
    	 
        $sql = "Select group_id from groups WHERE name ='" . $groupname . "';";
        $check  = mysql_query($sql);
    	
        while ($row1 = mysql_fetch_row($check)) {
   		$group_id=$row1[0];
   		echo $group_id;
   		}
   			
   		
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


?>
  
