<?php
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
   if (session_id() == '')
       {
       session_start();
       }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
   <meta charset="UTF-8">
      <title>Source Code Repository Management</title>
      <!-- Bootstrap -->
      <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
      <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
   </head>
   <body>
      <!-- Navbar
         ================================================== -->
      <div class="navbar navbar-inverse">
         <div class="navbar-inner">
            <div class="container">
               <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <?php
                  if ($_SESSION['LoggedIn'] !== TRUE)
                      {
                  ?>
               <a class="brand" href="login">Source Code Repository Management</a>
               <div class="nav-collapse collapse">
                  <ul class="nav">
                  <li class="active">
                     <a href="login">Log In</a>
                  </li>
                  <?php
                     }
                     else
                     {
                     ?>
                  <?php
                     if ($_SESSION['manager'] !== true)
                         {
                     ?>
                  <a class="brand" href="index">Source Code Repository Management</a>
                  <div class="nav-collapse collapse">
                     <ul class="nav">
                        <li class="">
                           <a href="index">Home</a>
                        </li>
                        <li class="">
                           <a href="loggedOut">Log Out</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <?php
            }
            else
            {
            ?>
         <a class="brand" href="index">Source Code Repository Management</a>
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
               <?php
                  }
                  }
                  ?>
            </ul>
         </div>
      </div>
 </div>
 </div>
   
      <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Delete User? </h3>
         </div>
         <div class="modal-body">
            <p>Are You Sure You Want To Delete This Users?</p>
         </div>
         <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-danger" name = 'action' value= 'delete' type='button' onclick ='confirmation()'>Delete</button></form>
         </div>
      </div>
         <!-- Le javascript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="<?php
         echo $view['assets']->getUrl('js/jQuery.dualListBox-1.3.js');
         ?>" type="text/javascript" ></script>
      <script src="<?php
         echo $view['assets']->getUrl('js/jquery.tablesorter.js');
         ?>" type="text/javascript" ></script>
      <script language="javascript" type="text/javascript">
         $(function() {
         
             $.configureBoxes();
         
         });
         
         
      </script>
      <script>
         function confirmation() {
          
                 document.getElementById("deleteUser").submit();
         
         }
      </script>
      <?php
         $view['slots']->output('title', 'Hello Application');
         ?>
      <script>
         var $rows = $('#table tr');
         $('#search').keyup(function() {
             var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
         
             $rows.show().filter(function() {
                 var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                 return !~text.indexOf(val);
             }).hide();
         });
      </script>
   </body>
</html>