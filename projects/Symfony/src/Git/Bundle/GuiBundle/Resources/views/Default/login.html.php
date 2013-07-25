<?php
   session_start();
   $view->extend('GitGuiBundle:Default:base.html.php');
   if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE) {
       header("Location:index");
       exit();
   } else {
       $view['slots']->start('title');
       if (isset($_SESSION['Alert']) && $_SESSION['Alert'] == TRUE) {
   ?> 
<div class= "row-fluid">
   <div class="span8 offset2">
      <div class="alert alert-block alert-error fade in">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <h4 class="alert-heading"> You got an error!</h4>
         <p>You have entered an incorrect username or password! Try again!</p>
      </div>
   </div>
</div>
<?php
   }
   ?>
<div class= "row-fluid">
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
            <button type="Submit" name ="Submit" class="btn">Submit</button>
         </fieldset>
      </form>
   </div>
</div>
<?php
   }
   $view['slots']->stop();
   ?>