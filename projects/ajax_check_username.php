<?php
	$con = mysql_connect("localhost", "root", "tucker24") or die("<p>Error connecting to database: " . mysql_error() . "</p>");



mysql_select_db("Test") or die("<p>Error selecting the database your-database-name: " . mysql_error() . "</p>");


$ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269") 
or die("Could not connect to LDAP server.");

$basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";

$logged_user     = $_COOKIE["TestUser"];
$logged_password = $_COOKIE["TestPass"];


$uname = "jsimpson1271";
$password ="tucker24";
$user ="time-inc-corp\\".$uname;
$ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269")
	or die("Could not connect to LDAP server.");

	$dsb = ldap_bind($ds, $user, $password); 
	
	if($!dsb)
       {
       
       header("Location: create");      
 		exit();

		}


//echo "hello";
	 
	if(isset($_POST['username']))//If a username has been submitted
	{
	$username = $_POST['username'];
	$filter    = "(sAMAccountName=" . $username. ")";
$justthese = array(
    "sn",
    "sAMAccountName",
    "givenName",
    "mail",
    "cn"
);
$sr   = ldap_search($ds, $basedn, $filter, $justthese);

$info = ldap_get_entries($ds, $sr);
	
	 
	$check_for_username =ldap_get_entries($ds, $sr);;
	//Query to check if username is available or not
	 
	if($check_for_username["count"] ===0){
	{
	echo '0';//If there is a  record match in the Database - Not Available
	}
	else
	{
	echo '1';//No Record Found - Username is available
	}
}
}
?>

