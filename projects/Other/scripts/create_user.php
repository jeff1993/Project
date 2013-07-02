<?php

require 'database_connection.php';

$First_Name = trim($_REQUEST['First_Name']);
$Last_Name = trim($_REQUEST['Last_Name']);
$Email = trim($_REQUEST['Email']);
$User_Name= strtolower(trim($_REQUEST['User_Name']));
$Password = trim($_REQUEST['Password']);

	
 $Check_User = mysql_query("SELECT  `User_Name` FROM  `user`;");

  if (!$Check_User) {
    die("<p>Error in listing tables: " . mysql_error() . "</p>");
  }


  while ($row = mysql_fetch_row($Check_User)) {
    
     if($User_Name === $row[0]){
     	echo "Please select a corret username";
     break;
     
     
     
     
     
     }
     
     else {
     
     $insert_sql = "INSERT INTO user (First_Name, Last_Name, Email, " .
                                 "User_Name, Password) " .
              "VALUES ('{$First_Name}', '{$Last_Name}', '{$Email}', " .
                      "'{$User_Name}', '{$Password}');";
                     
                      mysql_query($insert_sql)
  							or die(mysql_error());
  							
  							echo "Database Entry Added Successfully";


     
     
     }
    
  }

  
 



// Insert the user into the database

?>
