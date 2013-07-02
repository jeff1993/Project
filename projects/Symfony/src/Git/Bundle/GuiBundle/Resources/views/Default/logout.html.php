<?php
setcookie("TestUser", "", time()-3600);
setcookie("TestPass", "", time()-3600);

header("Location: logout");      
 		exit();	

?>
