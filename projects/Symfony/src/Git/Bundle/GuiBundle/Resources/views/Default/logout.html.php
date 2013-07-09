<?php
setcookie("LoggedUser", "", time()-3600);
setcookie("LoggedPass", "", time()-3600);

header("Location: logout");      
 		exit();	

?>
