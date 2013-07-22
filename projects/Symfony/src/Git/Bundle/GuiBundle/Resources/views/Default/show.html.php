<?php
   $view->extend('GitGuiBundle:Default:base.html.php');
   $view['slots']->start('title');
   session_start();
   require_once('scripts/database.php');
   //value passed from group list page
   //shows each of the users that are assigned to the groups
   if (isset($_POST['step']) && $_POST['step'] == 1) {
       //gets the group name from the drop down in the groups list page
       // $event = $_POST["groupName"];
   ?>
<div class="row-fluid">
<div class="span4 offset2">
   <?php
      $event = $_POST['name'];
      echo "<h1>" . $event . "</h1>";
      $getGroupID = mysql_query("SELECT group_id FROM groups where name ='" . $event . "';");
      while ($row1 = mysql_fetch_array($getGroupID)) {
          $groupID = $row1['group_id'];
      }
      if (isset($_SESSION['GroupAlterSuccess']) && $_SESSION['GroupAlterSuccess'] == TRUE) {
      ?> 
   <div class="alert alert-block alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" onClick="disable()";>&times;</button>
      <h4 class="alert-heading">Update Successfully</h4>
      <p>You Have Successfully Updated The Database</p>
   </div>
   <?php
      }
      ?>
   <!--From here till the end bracket is where you where we create the dual list view
      that you can assign users to the individual groups-->
   <form  action="" method="POST" >
      <div>
         <?php
            echo "<input type='hidden' name='groupname' id='groupname' value=' " . $event . " '/>";
            ?>
      </div>
      <div>
         <table>
            <tr>
               <td>
                  <legend>Users Not In <?php
                     echo $event;
                     ?> </legend>
                  <br/>
                  Filter: <input type="text" id="box1Filter" /><button type="button" class='btn btn-small'id="box1Clear">X</button><br />
                  <select id="box1View" name="box1View[]" multiple="multiple" style="height:500px;width:300px;">
                  <?php
                     $result = mysql_query("SELECT * FROM user ORDER BY username;");
                     while ($row1 = mysql_fetch_array($result)) {
                         $userID = $row1['user_id'];
                         $check  = mysql_query("Select * FROM group_management where groupID ='" . $groupID . "' and userID ='" . $userID . "';");
                         if (mysql_fetch_array($check) == 0) {
                             echo "<option id='" . $row1['username'] . "' name='box1View[]'  value='" . $row1['username'] . "'> " . $row1['username'] . "</option>";
                         }
                     }
                     ?>
                  </select><br/>
                  <span id="box1Counter" class="countLabel"></span>
                  <select id="box1Storage">
                  </select>
               </td>
               <td>
                  <button id="to2" type="button" class='btn btn-small'> > </button>
                  <button id="allTo2" type="button" class='btn btn-small'> >> </button>
                  <button id="allTo1" type="button" class='btn btn-small'> << </button>
                  <button id="to1" type="button" class='btn btn-small'> < </button>
               </td>
               <td>
                  <legend>Users Currently in <?php
                     echo $event;
                     ?> </legend>
                  <br/>
                  Filter: <input type="text" id="box2Filter" /><button type="button" class='btn btn-small' id="box2Clear">X</button><br />
                  <select id="box2View" name="box2View[]" multiple="multiple" style="height:500px;width:300px;">
                  <?php
                     $num2 = mysql_query("Select group_id from groups WHERE name ='" . $event . "';");
                     while ($row1 = mysql_fetch_row($num2)) {
                         $group_id = $row1[0];
                     }
                     $perm   = mysql_query("Select * from groups WHERE name ='" . $event . "';");
                     $result = mysql_query("SELECT userID FROM group_management WHERE groupID = '" . $group_id . "';");
                     while ($row1 = mysql_fetch_row($result)) {
                         $name     = $row1[0];
                         $username = mysql_query("SELECT * FROM user WHERE user_id = '" . $name . "' ORDER BY username;");
                         while ($row = mysql_fetch_array($username)) {
                             echo "<option id='" . $row['username'] . "' name='box2View[]'  value='" . $row['username'] . "'> " . $row['username'] . "</option>";
                         }
                     }
                     ?>
                  </select><br/>
                  <span id="box2Counter" class="countLabel"></span>
                  <select id="box2Storage">
                  </select>
               </td>
            </tr>
         </table>
      </div>
      <button type='Submit' name ='GroupSubmit' id ='GroupSubmit' value = 'GroupSubmit' class='btn'>Submit</button>
   </form>
</div>
<?php
   }
   //shows each of the groups that are assigned to each reposistory 
   if (isset($_POST['step']) && $_POST['step'] == 2) {
       $name      = $_REQUEST['groupdropdown'];
       $groupname = str_replace('/', ' ', $name);
       $event     = trim($groupname);
       $num2      = mysql_query("Select group_id from groups WHERE name ='" . $event . "';");
       while ($row1 = mysql_fetch_row($num2)) {
           $group_id = $row1[0];
       }
       $check = mysql_query("Select repoID from repo_management WHERE groupID ='" . $event . "';");
       foreach ($_POST['repo'] as $checkbox) {
           $reposlash = $checkbox;
           $groupname = str_replace('/', ' ', $reposlash);
           $checkbox  = trim($groupname);
           echo $checkbox;
           $sql   = "Select repo_id from repo WHERE name ='" . $checkbox . "';";
           $check = mysql_query($sql);
           while ($row1 = mysql_fetch_row($check)) {
               $repo_id = $row1[0];
           }
           $exists = mysql_query("Select * from repo_management where groupID='" . $group_id . "' and repoID='" . $repo_id . "';");
           if ($row = mysql_fetch_array($exists)) {
               $read   = $row['perm_read'];
               $write  = $row['perm_write'];
               $manage = $row['perm_manage'];
               $sql    = "UPDATE repo_management SET  perm_read ='" . $read . "',
                        perm_write ='" . $write . "',
                        perm_manage ='" . $manage . "'
                        WHERE groupID='" . $group_id . "' AND repoID ='" . $repo_id . "';";
               $check = mysql_query($sql) or die(mysql_error());
           } else {
               echo $repo_id;
               $insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
               mysql_query($insert_sql) or die(mysql_error());
               echo "success";
           }
           //Thinking about deleting from here down, because it doesn't make sense to alter, we just need to add if present and delete if not
       }
       echo " Alter success";
       $event = $_POST["groupdropdown"];
       echo "<form action='managerepo' method='POST'>
                        <input type='hidden' name='step' value='2' /> 
                        <input type='hidden' name='submitted' id='submitted' value=" . $event . "/>";
       echo "<h1>" . $event . "</h1>";
       echo "manage permissions for this repository";
       echo "<button type='Submit' name ='Submit' class='btn'>Submit</button>";
   }
   //sent from the manage repo page, used by the drop down
   if (isset($_POST['step']) && $_POST['step'] == 3) {
       $event = $_POST['name'];
       if (isset($_SESSION['RepoAlterSuccess']) && $_SESSION['RepoAlterSuccess'] == TRUE) {
   ?> 
<div class="alert alert-block alert-success fade in">
   <button type="button" class="close" data-dismiss="alert" onClick="disable()";>&times;</button>
   <h4 class="alert-heading">Update Successfully</h4>
   <p>You Have Successfully Updated The Database</p>
</div>
<?php
   }
   ?>
<div class="row-fluid">
<div class="span4">
<div class="span4 offset2">
<?php
   echo "<h1>" . $event . "</h1> </div> </div> </div>";
   $repo = mysql_query("SELECT * FROM repo WHERE name ='" . $event . "';");
   while ($row = mysql_fetch_array($repo)) {
       $repo_id = $row['repo_id'];
       $git     = $row['git'];
   }
   ?>
<!--From here  till the end of collapseOne is where you where we create the dual list view
   that you can assign groups to the individual repositories-->
<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
   <li class="active"><a href="#gR" data-toggle="tab">Assign Groups</a></li>
   <li><a href="#aR" data-toggle="tab">Adjust Groups Rights</a></li>
   <li><a href="#aT" data-toggle="tab">Adjust Group Type</a></li>
</ul>
<div class="tab-content">
   <div class="tab-pane active" id="gR">
      <div class='row-fluid'>
         <div class='span8'>
            <div class = "span3 offset1">
               <form  method="post" action="" >
                  <div>
                     <?php
                        echo "<input type='hidden' name='repoName' id='repoName' value=' " . $event . " '/>";
                        ?>
                  </div>
                  <div>
                     <table>
                        <tr>
                           <td>
                              <legend>Groups Not Assigned to <?php
                                 echo $event;
                                 ?></legend>
                              <br/>
                              Filter: <input type="text" id="box1Filter" /><button type="button" class='btn btn-small' id="box1Clear">X</button><br />
                              <select id="box1View" name="box1View[]" multiple="multiple" style="height:500px;width:300px;">
                              <?php
                                 $result = mysql_query("SELECT * FROM groups ORDER BY name;");
                                 while ($row1 = mysql_fetch_array($result)) {
                                     $groupID = $row1['group_id'];
                                     $check   = mysql_query("Select * FROM repo_management where groupID ='" . $groupID . "' and repoID ='" . $repo_id . "';");
                                     if (mysql_fetch_array($check) == 0) {
                                         echo "<option id='" . $row1['name'] . "' name='box1View[]'  value='" . $row1['name'] . "'> " . $row1['name'] . "</option>";
                                     }
                                 }
                                 ?>
                              </select><br/>
                              <span id="box1Counter" class="countLabel"></span>
                              <select id="box1Storage">
                              </select>
                           </td>
                           <td>
                              <button id="to2" type="button" class='btn btn-small'> > </button>
                              <button id="allTo2" type="button" class='btn btn-small'> >> </button>
                              <button id="allTo1" type="button" class='btn btn-small'> << </button>
                              <button id="to1" type="button" class='btn btn-small'> < </button>
                           </td>
                           <td>
                              <legend>Groups Currently Assigned  </legend>
                              <br/>
                              Filter: <input type="text" id="box2Filter" /><button type="button"  class='btn btn-small' id="box2Clear">X</button><br />
                              <select id="box2View" name="box2View[]" multiple="multiple" style="height:500px;width:300px;">
                              <?php
                                 $getGroupID = mysql_query("Select groupID from repo_management WHERE repoID ='" . $repo_id . "';");
                                 while ($row1 = mysql_fetch_array($getGroupID)) {
                                     $group_id     = $row1[0];
                                     $getGroupName = mysql_query("Select name FROM groups WHERE group_id ='" . $group_id . "';");
                                     $result       = mysql_query("SELECT userID FROM group_management WHERE groupID = '" . $group_id . "' ORDER BY name;");
                                     while ($row = mysql_fetch_array($getGroupName)) {
                                         echo "<option id='" . $row['name'] . "' name='box2View[]'  value='" . $row['name'] . "'> " . $row['name'] . "</option>";
                                     }
                                 }
                                 ?>
                              </select><br/>
                              <span id="box2Counter" class="countLabel"></span>
                              <select id="box2Storage">
                              </select>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <button type='Submit' name ='RepoSubmit' id ='RepoSubmit' class='btn'>Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="tab-pane" id="aR">
      <div class="span10">
         <fieldset>
            <legend> Change Group Permissions </legend>
            <?php
               $check = mysql_query("Select groupID from repo_management WHERE repoID ='" . $repo_id . "';");
               while ($row = mysql_fetch_row($check)) {
                   $group_id = $row[0];
               }
               echo "<table class='table table-bordered table-condensed table-striped'>
                                                                                         <tr>
                                                                                         <th>Group Name</th>
                                                                                         <th>Read</th>
                                                                                         <th>Write</th>
                                                                                         <th>Manage</th>
                                                                                         <th> Update</th>
                                                                                         </tr>";
               $perm = mysql_query("Select * from repo_management WHERE repoID ='" . $repo_id . "';");
               while ($row = mysql_fetch_array($perm)) {
                   //echo $row['groupID'];
                   $group = mysql_query("Select name from groups where group_id ='" . $row['groupID'] . "';");
                   while ($row3 = mysql_fetch_row($group)) {
                       $group_name = $row3[0];
                   }
                   echo "<form action='' method='POST'>
                                                                                         
                                                                                         <input type='hidden' name='submitted' id='submitted' value=" . $event . "/>
                                                                                         <input type= 'hidden' name ='groupName' id =groupName' value=" . $group_name . "/>";
                   echo "<tr>";
                   echo "<td>" . $group_name . "</td>";
                   if ($row['perm_read'] == 1) {
                       echo "<td>	<input type='checkbox' class='form' value='read' checked name='checkbox[]' /> Read</td>";
                   } else {
                       echo "<td><input type='checkbox' class='form' value='read' name='checkbox[]' /> Read</td>";
                   }
                   if ($row['perm_write'] == 1) {
                       echo "<td>	<input type='checkbox' class='form' value='write' checked name='checkbox[]' /> Write</td>";
                   } else {
                       echo "<td>	<input type='checkbox' class='form' value='write' name='checkbox[]' /> Write </td>";
                   }
                   if ($row['perm_manage'] == 1) {
                       echo "<td>	<input type='checkbox' class='form' value='manage' checked name='checkbox[]' /> Manage</td>";
                   } else {
                       echo "<td>	<input type='checkbox' class='form' value='manage' name='checkbox[]' /> Manage</td>";
                   }
                   echo "<td><button type='Submit' name ='PermissionSubmit' id = 'PermissionSubmit' class='btn'>Submit</button> </td>";
                   echo "</tr></form> </div> </div>";
               }
               echo " </table></div>";
               ?>
         </fieldset>
      </div>
      <div class ="tab-pane" id ="aT">
         <div class ="span6">
            <div class ="well">
               <h5>
               Your Current Repository Type 
               <h5>
               <?php
                  if ($git == 1) {
                      echo "Git";
                  } else {
                      echo "Svn";
                  }
                  ?>
               <br/>
               <form method = "post" action= "">
                  <input type='hidden' name='step' id='step' value='7'/>
                  <?php
                     echo "<input type='hidden' name='repoName' id='repoName' value=' " . $event . " '/>";
                     ?>
                  <br/>
                  <?php
                     //changes the default checked radio button depending on the type of repo it already is            
                     if ($git == 1) {
                         echo "<input type='radio' name='repoType' value='git' checked>Git  
                                                                                                                                                                                                             <input type='radio' name='repoType' value='svn'>Svn";
                     } else {
                         echo "<input type='radio' name='repoType' value='git'>Git  
                                                                                                                                                                                                             <input type='radio' name='repoType' value='svn' checked>Svn";
                     }
                     ?>
                  <br/>
                  <br/>
                  <button type='Submit' name ='ChangeRepoSubmit' id = 'ChangeRepoSubmit' class='btn btn-small'>Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   } else {
       if (isset($_POST['GroupSubmit'])) {
           $_SESSION['GroupAlterSuccess'] = true;
           $groupname                     = $_POST['groupname'];
           $groupslash                    = str_replace('/', ' ', $groupname);
           $groupname                     = trim($groupslash);
           $groupcheck                    = mysql_query("SELECT group_id FROM groups WHERE NAME ='" . $groupname . "';");
           while ($row = mysql_fetch_row($groupcheck)) {
               $group_id = $row[0];
           }
           //if the 2nd box is empty we are to delete all association of users to that repo
           if (empty($_POST['box2View'])) {
               $clear = mysql_query("DELETE FROM group_management WHERE groupID ='" . $group_id . "';");
           } else {
               //to fix some bugs I automatically clear the entire list. So that way 
               //whenever you readd these users the ones you removed from the group
               //still won't have an entry. Only those who are left in the column.
               $clear = mysql_query("DELETE FROM group_management WHERE groupID ='" . $group_id . "';");
               foreach ($_POST['box2View'] as $selected) {
                   //same fix for the slash problem.
                   $username  = $selected;
                   $user      = str_replace('/', ' ', $username);
                   $username  = trim($user);
                   $usercheck = mysql_query("SELECT user_id FROM user WHERE username ='" . $username . "';");
                   while ($row = mysql_fetch_row($usercheck)) {
                       $user_id = $row[0];
                   }
                   $check = mysql_query("SELECT  * FROM group_management WHERE groupID ='" . $group_id . "' and userID='" . $user_id . "';");
                   if (mysql_fetch_row($check)) {
                       //if there are 2 of the same users it will just update the time compenent (which is useless but solves the bug)
                       $timeUpdate = "UPDATE group_management SET  time ='" . time() . "'
                                								  WHERE groupID='" . $group_id . "' AND userID ='" . $user_id . "';";
                       mysql_query($timeUpdate) or die(mysql_error());
                   } else {
                       //finally adds to group_manage the association between users and groups
                       $insert_sql = "INSERT INTO group_management (groupID, userID) " . "VALUES ('{$group_id}', '{$user_id}');";
                       mysql_query($insert_sql) or die(mysql_error());
                   }
               }
           }
           echo "
                  			 <form action='show' method='POST' id ='deleteUser'> 
                           <input type='hidden' name='step' value='1' /> 
                           <input type='hidden' name= 'name' value ='" . $groupname . "'/> </form>";
           $_SESSION['GroupAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
       //sent from the assigning groups to repos page, the dual list  
       if (isset($_POST['RepoSubmit'])) {
           //gets the groupID, removes the slash, replaces it with a space, then removes the space.
           $repoName  = $_POST['repoName'];
           $reposlash = str_replace('/', ' ', $repoName);
           $repoName  = trim($reposlash);
           $repocheck = mysql_query("SELECT repo_id FROM repo WHERE name ='" . $repoName . "';");
           while ($row = mysql_fetch_row($repocheck)) {
               $repo_id = $row[0];
           }
           $clear = "DELETE FROM repo_management WHERE repoID ='" . $repo_id . "';";
           if (empty($_POST['box2View'])) {
               mysql_query($clear) or die(mysql_error());
           } else {
               mysql_query($clear) or die(mysql_error());
               foreach ($_POST['box2View'] as $selected) {
                   $groupName  = $selected;
                   $group      = str_replace('/', ' ', $groupName);
                   $groupName  = trim($group);
                   $getGroupID = mysql_query("SELECT group_id FROM groups WHERE name ='" . $groupName . "';");
                   while ($row = mysql_fetch_row($getGroupID)) {
                       $group_id = $row[0];
                   }
                   while ($row = mysql_fetch_row($getGroupID)) {
                       $group_id = $row[0];
                   }
                   $check = mysql_query("SELECT  * FROM repo_management WHERE groupID ='" . $group_id . "' and repoID='" . $repo_id . "';");
                   if (mysql_fetch_row($check)) {
                       $timeUpdate = "UPDATE repo_management SET  time ='" . time() . "'
                            WHERE groupID='" . $group_id . "' AND repoID ='" . $repo_id . "';";
                       mysql_query($timeUpdate) or die(mysql_error());
                   } else {
                       $insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
                       mysql_query($insert_sql) or die(mysql_error());
                   }
               }
           }
           echo "
                        	 <form action='show' method='POST' id ='deleteUser'> 
                         <input type='hidden' name='step' value='3' /> 
                          <input type='hidden' name= 'name' value ='" . $repoName . "'/> </form>";
           $_SESSION['RepoAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
       //updates type of repository, sent from show 3
       if (isset($_POST['ChangeRepoSubmit'])) {
           $repoName = $_REQUEST['repoName'];
           $repo     = trim($repoName);
           $type     = $_REQUEST['repoType'];
           if ($type == 'git') {
               $git = 1;
               $svn = 0;
           } else {
               $git = 0;
               $svn = 1;
           }
           $insert_query = "UPDATE repo SET git ='" . $git . "', svn ='" . $svn . "' WHERE name ='" . $repo . "';";
           mysql_query($insert_query) or die(mysql_error());
           echo "
                        	 <form action='show' method='POST' id ='deleteUser'> 
                                 <input type='hidden' name='step' value='3' /> 
                                 <input type='hidden' name= 'name' value ='" . $repo . "'/> </form>";
           $_SESSION['RepoAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
       //This is passed from Show Step 3. It is displayed under the the Groups to Repo
       //dual view list. 
       //Purpose:
       //Submits the changes  of the permisions of the groups to a specific repo
       //Checks each of the check boxes and passes them into this function
       //if checked marked in repo_management table as 1, if not a 0
       if (isset($_POST['PermissionSubmit'])) {
           //removes the slashes that are present in the repository name and the group name
           $reponame   = $_REQUEST['submitted'];
           $reposlash  = str_replace('/', ' ', $reponame);
           $reponame   = trim($reposlash);
           $groupname  = $_REQUEST['groupName'];
           $groupslash = str_replace('/', ' ', $groupname);
           $groupname  = trim($groupslash);
           $num2       = mysql_query("Select repo_id from repo WHERE name ='" . $reponame . "';");
           while ($row1 = mysql_fetch_row($num2)) {
               $repo_id = $row1[0];
           }
           $sql   = "Select group_id from groups WHERE name ='" . $groupname . "';";
           $check = mysql_query($sql);
           while ($row1 = mysql_fetch_row($check)) {
               $group_id = $row1[0];
           }
           //read is always selected because there is no instance where you wouldn't want a group to be in the repo and not able to read
           $read   = 1;
           $write  = 0;
           $manage = 0;
           foreach ($_POST['checkbox'] as $checkbox) {
               if ($checkbox === "read") {
                   $read = 1;
               }
               if ($checkbox === "write") {
                   $write = 1;
               }
               if ($checkbox === "manage") {
                   $manage = 1;
               }
               $exists = mysql_query("Select * from repo_management where groupID='" . $group_id . "' and repoID='" . $repo_id . "';");
               if ($row = mysql_fetch_array($exists)) {
                   $sql = "UPDATE repo_management SET  perm_read ='" . $read . "',
               perm_write ='" . $write . "',
               perm_manage ='" . $manage . "'
                WHERE groupID='" . $group_id . "' AND repoID ='" . $repo_id . "';";
                   $check = mysql_query($sql) or die(mysql_error());
               } else {
                   echo $repo_id;
                   $insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
                   mysql_query($insert_sql) or die(mysql_error());
               }
           }
           echo "<form action='show' method='POST' id ='deleteUser'> 
                <input type='hidden' name='step' value='3' /> 
             <input type='hidden' name= 'name' value ='".$reponame."'/> </form>";
           $_SESSION['RepoAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
   }
   $view['slots']->stop();
   ?>