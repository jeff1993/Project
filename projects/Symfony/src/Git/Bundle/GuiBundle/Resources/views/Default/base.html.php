<?php 
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
   if(session_id() == '') {
      session_start();
   }
     ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Source Code Repository Management</title>
      <!-- Bootstrap -->
      <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
      <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
   </head>
   <body>
    <!-- Navbar
    ================================================== -->

    <div class="navbar">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
       <?php   if ($_SESSION['LoggedIn'] !== TRUE) {
       ?>
<a class="brand" href="login">Source Code Repository Management</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
            <li class="active">
               <a href="login">Log In</a>
              </li>
            <?php
}
else {


?>
          <a class="brand" href="#">Source Code Repository Management</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
               <a href="index">Home</a>
              </li>
              <li class="">
               <a href="create">Create Users</a>
              </li>
              <li class="">
                <a href="group">Manage Groups</a>
              </li>
              <li class="">
                <a href="repo">Manage Repositories</a>
              </li>
              <li class="">
                <a href="../../../../../../../gitlist/index.php">View Repositories</a>
              </li>
              <li class="">
                <a href="loggedOut">Log Out</a>
              </li>
              <?php } ?>
           
            </ul>
          </div>
        </div>
      </div>
    </div>


<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="<?php echo $view['assets']->getUrl('js/jQuery.dualListBox-1.3.js') ?>" type="text/javascript" ></script>
   <script src="<?php echo $view['assets']->getUrl('js/jquery.tablesorter.js') ?>" type="text/javascript" ></script>
   <script language="javascript" type="text/javascript">
      $(function() {
      
          $.configureBoxes();
      
      });
      
   </script>
   

      <?php
         $view['slots']->output('title', 'Hello Application') ?>
   </body>
</html>