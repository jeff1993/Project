
<?php
session_start();


$userName = trim($_REQUEST['username']);
$password =$_REQUEST['password'];
$user ="time-inc-corp\\".$userName;
$ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269")
	or die("Could not connect to LDAP server.");


setcookie("LoggedUser", $userName);

$basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";



if ($ds)
 { 

	try
	{

   	$dsb = ldap_bind($ds, $user, $password);  
   	   
       if($dsb)
       {
       $_SESSION['LoggedIn'] = true;
       header("Location: create");      
 		exit();

		}
	}
	catch (Exception $e)
	{
	
		header("Location: login");	
		exit();	
		throw new Exception (' Something really gone wrong', 0, $e);
		
	}
 }
else {
		$_SESSION['LoggedIn']= false;
		header("Location: login");	
		exit();	





}
?>
