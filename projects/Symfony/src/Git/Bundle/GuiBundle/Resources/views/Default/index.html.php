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
   }
   if (isset($_POST['Submit'])) {
       $userID     = $_REQUEST['userID'];
       $ssh        = $_REQUEST['ssh'];
       $sshName    = $_REQUEST['sshName'];
       $insert_sql = "INSERT INTO ssh_key(ssh_key, name) " . "VALUES ('{$ssh}', '{$sshName}');";
       mysql_query($insert_sql) or die(mysql_error());
       $search = "Select sshID from ssh_key where ssh_key ='" . $ssh . "';";
       $sshQuery = mysql_query($search) or die(mysql_error());
       if ($row = mysql_fetch_row($sshQuery)) {
           $sshID = $row[0];
       }
       $insertManagement = "INSERT INTO ssh_management(sshID, userID) " . "VALUES ('{$sshID}', '{$userID}');";
       mysql_query($insertManagement) or die(mysql_error());
       $_SESSION['Success'] = True;
       header('Location: index');
       exit();
   }
   
   
   if (isset($_POST['delete'])) {
          echo "<script>show();</script>";
   		 $userID     = $_REQUEST['userID'];
      	 $sshID        = $_REQUEST['sshID'];

      echo "<form action='add' method='POST' id ='deleteUser'>  
        <input type='hidden' name='step' value='4'/> 
       <input type='hidden' name='userID' value='" . $userID . "'/>
       <input type='hidden' name='sshID' value='" . $sshID . "'/></form>";
   
    
     
   }
   
   
   
   
   
   echo "<h2> Welcome " . $firstName . " " . $lastName . "</h2>";
   ?>
<div class="tabbable tabs-left">
   <ul class="nav nav-tabs">
      <li class="active"><a href="#lA" data-toggle="tab">Current SSH Keys</a></li>
      <li><a href="#lB" data-toggle="tab">Add SSH Keys</a></li>
      <li><a href="#lC" data-toggle="tab">Group Membership</a></li>
   </ul>
   <div class="tab-content">
      <div class="tab-pane active" id="lA">
         <?php
            if (isset($_SESSION['Success']) && $_SESSION['Success'] == TRUE) {
            ?> 
         <div class="span8">
            <div class="alert alert-block alert-success fade in">
               <button type="button" class="close" data-dismiss="alert">&times;</button>
               <h4 class="alert-heading">Update Successfully</h4>
               <p>You Have Successfully Updated The Database</p>
            </div>
         </div>
         <?php
            }
            ?>     
         <legend> Your Current SSH Keys </legend>
         <table class ='table table-striped' >
            <tr>
               <th> Name </th>
               <th> SSH Key </th>
               <th> Delete? </th>
            </tr>
            <?php
               $result = mysql_query("SELECT sshID FROM ssh_management WHERE userID='" . $userID . "';") or die(mysql_error());
               while ($row = mysql_fetch_row($result)) {
                   $sshID   = $row[0];
                   $sshInfo = mysql_query("SELECT * FROM ssh_key WHERE sshID='" . $sshID . "';");
                   if ($row1 = mysql_fetch_array($sshInfo)) {
                       $name     = $row1['name'];
                       $sshKey   = $row1['ssh_key'];
                       $shortKey = substr($sshKey, 0, 25) . "...";
                        ?> <form action="" method="POST">
           			    <?php
                  echo "<input type='hidden' name='userID' value='" . $userID . "'/>
                  <input type='hidden' name='sshID' value='" . $sshID . "'/>";
                       echo "<tr>
                                                      			<td>" . $name . " </td>
                                                      			<td>" . $shortKey . " </td>
                                                      			<td><button class='btn btn-danger btn-small' id ='delete' name = 'delete' value ='delete' type='submit'>Delete</td>
                                                      			</tr></form>";
                   }
               }
               ?>
         </table>
      </div>
      <div class="tab-pane" id="lB">
         <fieldset>
            <legend>Update Your SSH Key</legend>
            <form action="" method="POST">
               <?php
                  echo "<input type='hidden' name='userID' value='" . $userID . "'/>";
                  ?>
               <input type='hidden' name='step' value='6' />
               <label for='sshName' >Name*:</label>
               <input type='text' name='sshName' id='sshName' required  maxlength="50" />
               <label for='ssh' >SSH Public Key*:</label>
               <textarea class ='input-xxlarge' rows='10' name='ssh' id='ssh' required /></textarea>
               <br/> 
               <button type="Submit" name ="Submit" value ="Submit" class="btn">Submit</button>
            </form>
         </fieldset>
      </div>
      <div class="tab-pane" id="lC">
         <fieldset>
            <legend> Group Memberships </legend>
            <p class="lead">
               <?php
                  $groups = mysql_query("SELECT groupID from group_management where userID ='" . $userID . "';");
                  while ($row = mysql_fetch_array($groups)) {
                      $groupID   = $row[0];
                      $groupName = mysql_query("SELECT name from groups where group_id ='" . $groupID . "';");
                      while ($row1 = mysql_fetch_array($groupName)) {
                          $gName = $row1[0];
                          echo $gName;
                          echo "<br/>";
                      }
                  }
                  ?>
            </p>
         </fieldset>
      </div>
   </div>
</div>
</div> <!-- /tabbable -->
<?php
   $view['slots']->stop();
   ?>
