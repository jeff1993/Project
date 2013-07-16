<?php
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
   $view->extend('GitGuiBundle:Default:base.html.php');
   $view['slots']->start('title');
   session_start();
   if ($_SESSION['LoggedIn'] !== TRUE) {
       header("Location:login");
       exit();
   }
   $userName = $_COOKIE["LoggedUser"];
   $userInfo = mysql_query("SELECT * FROM user WHERE username ='" . $userName . "';");
   while ($row = mysql_fetch_array($userInfo)) {
       $firstName = $row['first_name'];
       $lastName  = $row['last_name'];
       $userID    = $row['user_id'];
       $ssh       = $row['ssh_key'];
   }
   ?>
<div class='row-fluid'>
<div class='span8 offset2'>
   <?php
      echo "<h2> Welcome " . $firstName . " " . $lastName . "</h2>";
      ?>
   <fieldset >
      <legend>Update Your SSH Key</legend>
      <div class ="span3">
         <h4>
         Your Current SSH Key 
         <h4>
         <?php
            echo $ssh;
            ?>
      </div>
      <div class = "span3">
         <form action="add" method="POST">
            <?php echo "<input type='hidden' name='userID' value='".$userID."'/>";?>
            <input type='hidden' name='step' value='6' />
            <label for='ssh' >SSH Key*:</label>
            <input type='text' name='ssh' id='ssh' required  maxlength="50" />
            <br/> 
            <button type="Submit" name ="Submit" class="btn">Submit</button>
         </form>
   </fieldset>
   <br/>
   <fieldset>
   <legend> Groups You Are Apart of </legend>
   <p class="lead">
   <?php
      $groups = mysql_query("SELECT groupID from group_management where userID ='" . $userID . "';");
      while ($row = mysql_fetch_array($groups)) {
          $groupID   = $row[0];
          $groupName = mysql_query("SELECT name from groups where group_id ='" . $groupID . "';");
          while ($row1 = mysql_fetch_array($groupName)) {
              $gName = $row1[0];
              echo $gName;
          }
      }
      ?>
   </p>
   </fieldset>
   </div>
</div>
<?php
   $view['slots']->stop();
   ?>