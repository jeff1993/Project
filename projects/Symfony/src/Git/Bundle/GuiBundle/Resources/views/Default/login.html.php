<?php
   session_start();
   $view->extend('GitGuiBundle:Default:base.html.php');
       
   if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE){
   
   
      header("Location:create");
   
      exit();
   }
   
    else {
   $view['slots']->start('title');
   
    if (isset($_SESSION['Alert']) && $_SESSION['Alert'] == TRUE){
   ?> <br/><br/><br/>
   <div class="span12 pagination-centered">
       <div class="alert alert-block alert-error fade in">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Oh snap! You got an error!</h4>
            <p>You have entered an incorrect username and password! Try again!</p>
   
          </div>
          <?php
   }
   
   ?>
   
   
   
   
   

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
