<?php

$First_Name = trim($_REQUEST['First_Name']);
$Last_Name = trim($_REQUEST['Last_Name']);
$Email = trim($_REQUEST['Email']);
$User_Name= strtolower(trim($_REQUEST['User_Name']));
$Password = trim($_REQUEST['Password']);



if ($User_Name = "jeff"){

	echo "<p>hello world </p>";



}	
 
 else {
 
 echo "<p> You failed </p>";


}
// Insert the user into the database

?>
