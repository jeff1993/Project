<?php
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
   if (session_id() == '') {
       session_start();
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Source Code Repository Management</title>
      <!-- Bootstrap -->
      <link href="<?php
         echo $view['assets']->getUrl('bootstrap/css/bootstrap.css');
         ?>" rel="stylesheet" >
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
                  if ($_SESSION['LoggedIn'] !== TRUE) {
                  ?>
               <a class="brand" href="login">Source Code Repository Management</a>
               <div class="nav-collapse collapse">
                  <ul class="nav">
                  <li class="active">
                     <a href="login">Log In</a>
                  </li>
                  <?php
                     } else {
                     ?>
                  <?php
                     if ($_SESSION['manager'] !== true) {
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
            } else {
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
         function show()
         {
         $('#myModal').modal('show')
         }
         
      </script>
      <script>
         function show1()
            {
            $('#EditModal').modal('show')
            }
            
      </script>
      <script>
         function confirmation() {
          
                 document.getElementById("deleteUser").submit();
         
         }
      </script>
      <Script>
         function disable(){
         <?php
            $_SESSION['CreateSuccess'] = false;
            $_SESSION['Alert']         = false;
            $_SESSION['Success']       = false;
            $_SESSION['GroupSuccess']  = false;
            $_SESSION['GroupAlert']    = false;
            $_SESSION['OptionAlert']    = false;
            $_SESSION['RepoAlert']     = false;
            $_SESSION['RepoSuccess']   = false;
            ?>
         
         
         }
      </script>
      <?php
         $view['slots']->output('title', 'Hello Application');
         ?>
      <script>
         $("a").tooltip({
                         'selector': '',
                         'placement': 'right'
                       });           
      </script>
      <script>
         function Search() {
         var value = $('input[id$="txtSearch"]').val();
         if (value) {
         $('#table tr:not(:first)').each(function () {
            var index = -1;
            $(this).children('td').each(function () {
                var text = $(this).text();
                if (text.toLowerCase().indexOf(value.toLowerCase()) != -1) {
                    index = 0;
                    return false;
                }
            });
            if (index == 0)
                $(this).show();
            else
                $(this).hide();
         });
         }
         else
         $('#table tr').show();
         }
      </script>
   </body>
</html>