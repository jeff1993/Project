<script>
function myFunction()
{
alert("I am an alert box!"); // this is the message in ""
}
</script>

<?php


mysql_connect("localhost", "root", "tucker24") or die("<p>Error connecting to database: " . mysql_error() . "</p>");

mysql_select_db("Test") or die("<p>Error selecting the database your-database-name: " . mysql_error() . "</p>");



if ($_POST['step'] == 1) {

	$name      = $_GET['event'];
    $groupname = str_replace('/', ' ', $name);
    $event      = trim($groupname);

	echo $event;
}
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





?>
  
