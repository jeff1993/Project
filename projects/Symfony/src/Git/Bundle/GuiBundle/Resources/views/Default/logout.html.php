<?php
session_start();
setcookie("LoggedUser", "", time()-3600);
setcookie("LoggedPass", "", time()-3600);

unset($_SESSION['LoggedIn']);
session_destroy();
session_start();
$_SESSION['LoggedIn']=false;
header("Location: login");      
 		exit();	



?>
