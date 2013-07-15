<?php
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
   $view->extend('GitGuiBundle:Default:base.html.php');
   $view['slots']->start('title');
   session_start();
   if ($_SESSION['LoggedIn'] !== TRUE)
       {
       header("Location:login");
       exit();
       }
   $userName = $_COOKIE["LoggedUser"];
   $userInfo = mysql_query("SELECT * FROM user WHERE username ='" . $userName . "';");
   while ($row = mysql_fetch_array($userInfo))
       {
       $firstName = $row['first_name'];
       $lastName  = $row['last_name'];
       $userID    = $row['user_id'];
       }
   echo "<h2> Welcome " . $firstName . " " . $lastName . "</h2>";
   ?>
<div class="accordion" id="accordion2">
<div class="accordion-group">
   <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
      Groups You Are Apart Of
      </a>
   </div>
   <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner">
         <div class='row-fluid'>
            <div class='span8 offset2'>
               <?php
                  $groups = mysql_query("SELECT groupID from group_management where userID ='" . $userID . "';");
                  while ($row = mysql_fetch_array($groups))
                      {
                      $groupID   = $row[0];
                      $groupName = mysql_query("SELECT name from groups where group_id ='" . $groupID . "';");
                      while ($row1 = mysql_fetch_array($groupName))
                          {
                          $gName = $row1[0];
                          echo $gName;
                          }
                      }
                  ?>
            </div>
         </div>
      </div>
   </div>
   <div class="accordion-group">
      <div class="accordion-heading">
         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
         Adjust Group Permissions
         </a>
      </div>
      <div id="collapseTwo" class="accordion-body collapse">
         <div class="accordion-inner">
         </div>
      </div>
   </div>
</div>
<?php
   $view['slots']->stop();
   ?>