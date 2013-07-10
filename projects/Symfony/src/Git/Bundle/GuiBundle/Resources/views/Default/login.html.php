<?php
	
session_start();
$view->extend('GitGuiBundle:Default:base.html.php');
    
if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE){


   header("Location:create");

   exit();
}

 else {
$view['slots']->start('title');



?>


<div class="span12 pagination-centered">

 <form action="authorize" method="POST">
<fieldset >
<legend>Login</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
 
<label for='username' >UserName*:</label>
<input type='text' name='username' id='username'  maxlength="50" required />
 
<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength="50" required />

<br/>
 
<input type='submit' name='Submit' value='Submit' />
 
</fieldset>
</form>
   
</div>
		
<?php 


}
$view['slots']->stop();

?>
