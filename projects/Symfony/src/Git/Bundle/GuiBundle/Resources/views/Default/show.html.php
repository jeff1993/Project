<?php
   require_once('scripts/database.php');
   $view->extend('GitGuiBundle:Default:base.html.php');
   $view['slots']->start('title');
   session_start();
   //value passed from group list page
   //shows each of the users that are assigned to the groups
   if (isset($_POST['step']) && $_POST['step'] == 1) {
       if (isset($_SESSION['GroupAlterSuccess']) && $_SESSION['GroupAlterSuccess'] == TRUE) {
   ?> 
<div class='span11 offset2'>
   <div class="alert alert-block alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" onClick="<?php
         $_SESSION['GroupAlterSuccess'] = false?>";>&times;</button>
      <h4 class="alert-heading">Update Successfully</h4>
      <p>You Have Successfully Updated The Database</p>
   </div>
</div>
<?php
   }
   ?>
<div class="row-fluid">
<div class='span10'>
<?php
   $event = $_POST['name'];
   echo "<h1>" . $event . "</h1>";
   $getGroupID = mysql_query("SELECT group_id FROM groups where name ='" . $event . "';");
   while ($row1 = mysql_fetch_array($getGroupID)) {
       $groupID = $row1['group_id'];
   }
   ?>
<div class="tabbable tabs-left">
   <ul class="nav nav-tabs">
      <li class="active"><a href="#gR" data-toggle="tab">Assign Users</a></li>
      <li><a href="#aR" data-toggle="tab">Adjust Paths</a></li>
   </ul>
   <div class="tab-content">
      <div class="tab-pane active" id="gR">
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
      <div class="tab-pane" id="aR">
         <form action="" method="POST">
            <fieldset >
               <legend>Create New <a href="#" rel="tooltip" title="If the path is '/sam/' the user will have access to
                  every path that icludes 'sam' and its variations">Path</a></legend>
               <input type='hidden' name='step' value='2' />
               <?php
                  echo "<input type='hidden' name='groupID' value='" . $groupID . "' />";
                  echo "<input type='hidden' name='groupName' value='" . $event . "' />";
                  ?>
               <label for='username' >Path*:</label>
               <input type='text' name='path' id='path' required  maxlength="50" />
               <br/>
               <input type="checkbox" name="adjust[]" value="createRepo" > Create Additional Sub-Repositories
               <br/>
               <input type="checkbox" name="adjust[]" value="addGroup"> Add Additional Groups to Sub-Repositories
               <br/> 
               <br/> 
               <button type="PathSubmit" name ="PathSubmit" class="btn">Submit</button>
            </fieldset>
         </form>
      </div>
   </div>
</div>
<?php
   }
   if (isset($_POST['step']) && $_POST['step'] == 3) {
       $event = $_POST['name'];
       $git   = $_POST['git'];
       if (isset($_SESSION['RepoAlterSuccess']) && $_SESSION['RepoAlterSuccess'] == TRUE) {
   ?> 
<div class='span11 offset2'>
   <div class="alert alert-block alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" onClick="<?php
         $_SESSION['RepoAlterSuccess'] = false?>";>&times;</button>
      <h4 class="alert-heading">Update Successfully</h4>
      <p>You Have Successfully Updated The Database</p>
   </div>
</div>
<?php
   }
   ?>
<div class="row-fluid">
<div class="span8 offset2">
<?php
   echo "<h1>" . $event . "</h1> </div> </div>";
   $repo = mysql_query("SELECT * FROM repo WHERE name ='" . $event . "' AND git ='" . $git . "';");
   while ($row = mysql_fetch_array($repo)) {
       $repo_id = $row['repo_id'];
       $git     = $row['git'];
       $Desc    = $row['description'];
   }
   ?>
<!--From here  till the end of collapseOne is where you where we create the dual list view
   that you can assign groups to the individual repositories-->
<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
   <li class="active"><a href="#gR" data-toggle="tab">Assign Repositories</a></li>
   <li><a href="#aR" data-toggle="tab">Adjust Repository Rights</a></li>
   <li><a href="#aD" data-toggle="tab">Adjust Description</a></li>
   <li><a href="#aP" data-toggle="tab">Adjust Path</a></li>
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
                     echo "<input type='hidden' name='git' value='" . $git . "' /> ";
                     ?>
               </div>
               <div>
                  <table>
                     <tr>
                        <td>
                           <legend>Repos Currently Not Assigned</legend>
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
                           <legend>Repos Currently Assigned  </legend>
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
         <legend> Change Repository Permissions </legend>
         <?php
            echo "<table class='table table-bordered table-condensed table-striped'>
                                                                                                                                                                  <tr>
                                                                                                                                                                  <th>Group Name</th>
                                                                                                                                                                  <th>Read</th>
                                                                                                                                                                  <th>Write</th>
                                                                                                                                                                  <th>Manage</th>
                                                                                                                                                                  <th> Update</th>
                                                                                                                                                                  </tr>";
            $check = mysql_query("Select * from repo_management WHERE repoID ='" . $repo_id . "';");
            while ($row = mysql_fetch_array($check)) {
                $group_id = $row['groupID'];
                $group    = mysql_query("Select name from groups where group_id ='" . $group_id . "';");
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
   <div class="tab-pane" id="aD">
      <form action='' method ='POST'>
         <label for='description' >Update Description*:</label>
         <?php
            echo "<textarea class ='input-xxlarge' rows='10' name='description' id='description' required />" . $Desc . "</textarea>";
            echo " <input type='hidden' name='repoID' id='repoID' value='" . $repo_id . "'/>";
            echo " <input type='hidden' name='git' id='git' value='" . $git . "'/>";
            echo " <input type='hidden' name='repoName' id='repoName' value='" . $event . "'/>";
            ?>
         </br>
         <button type='Submit' name ='DescriptionSubmit' id = 'DescriptionSubmit' class='btn'>Submit</button>
      </form>
   </div>
   <div class="tab-pane" id="aP">
      <legend> Current Path </legend>
      <?php
         $pathQuery = "SELECT path FROM repo WHERE repo_id = '" . $repo_id . "';";
         $query = mysql_query($pathQuery) or die(mysql_error());
         while ($row = mysql_fetch_row($query)) {
             $path = $row[0];
         }
         echo "<h3>" . $path . "</h3>";
         ?>
      <form action='' method ='POST'>
         <legend>Update Path</legend>
         <?php
            echo "<textarea class ='input-xxlarge' rows='2' name='path' id='path' required ></textarea>";
            echo " <input type='hidden' name='repoID' id='repoID' value='" . $repo_id . "'/>";
            echo " <input type='hidden' name='git' id='git' value='" . $git . "'/>";
            echo " <input type='hidden' name='repoName' id='repoName' value='" . $event . "'/>";
            ?>
         </br>
         <button type='Submit' name ='RepoPath' id = 'RepoPath' class='btn'>Submit</button>
      </form>
   </div>
</div>
<?php
   } else {
       if (isset($_POST['RepoPath'])) {
           $repoID     = $_REQUEST['repoID'];
           $path       = $_REQUEST['path'];
           $git        = $_REQUEST['git'];
           $repoName   = $_REQUEST['repoName'];
           $repoUpdate = "UPDATE repo SET  path ='" . $path . "' WHERE repo_id='" . $repoID . "';";
           mysql_query($repoUpdate) or die(mysql_error());
           echo " <form action='show' method='POST' id ='deleteUser'> 
                                                 <input type='hidden' name='step' value='3' /> 
                                                 <input type='hidden' name='git' value='" . $git . "' /> 
                                                  <input type='hidden' name= 'name' value ='" . $repoName . "'/> </form>";
           $_SESSION['RepoAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
       if (isset($_POST['PathSubmit'])) {
           $groupID    = $_REQUEST['groupID'];
           $path       = $_REQUEST['path'];
           $groupname  = $_POST['groupName'];
           $groupslash = str_replace('/', ' ', $groupname);
           $groupname  = trim($groupslash);
           $addGroup   = 0;
           $createRepo = 0;
           foreach ($_POST['adjust'] as $checkbox) {
               if ($checkbox === "createRepo") {
                   $createRepo = 1;
               }
               if ($checkbox === "addGroup") {
                   $addGroup = 1;
               }
           }
           $insert_sql = "INSERT INTO repo_path (groupID, repo_path, create_repo, add_group) " . "VALUES ('{$groupID}', '{$path}' ,'{$path}', '{$path}');";
           mysql_query($insert_sql) or die(mysql_error());
           echo "<form action='show' method='POST' id ='deleteUser'> 
                                        <input type='hidden' name='step' value='1' /> 
                                        <input type='hidden' name= 'name' value ='" . $groupname . "'/> </form>";
           $_SESSION['GroupAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
       if (isset($_POST['DescriptionSubmit'])) {
           $description = $_REQUEST['description'];
           $repoID      = $_REQUEST['repoID'];
           $git         = $_REQUEST['git'];
           $repoName    = $_REQUEST['repoName'];
           $repoUpdate  = "UPDATE repo SET  description ='" . $description . "'
                                                        								  WHERE repo_id='" . $repoID . "';";
           mysql_query($repoUpdate) or die(mysql_error());
           echo " <form action='show' method='POST' id ='deleteUser'> 
                                                 <input type='hidden' name='step' value='3' /> 
                                                 <input type='hidden' name='git' value='" . $git . "' /> 
                                                  <input type='hidden' name= 'name' value ='" . $repoName . "'/> </form>";
           $_SESSION['RepoAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
       if (isset($_POST['GroupSubmit'])) {
           $groupname  = $_POST['groupname'];
           $groupslash = str_replace('/', ' ', $groupname);
           $groupname  = trim($groupslash);
           $groupcheck = mysql_query("SELECT group_id FROM groups WHERE NAME ='" . $groupname . "';");
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
           echo "<form action='show' method='POST' id ='deleteUser'> 
                                        <input type='hidden' name='step' value='1' /> 
                                        <input type='hidden' name= 'name' value ='" . $groupname . "'/> </form>";
           $_SESSION['GroupAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
       //sent from the assigning groups to repos page, the dual list  
       if (isset($_POST['RepoSubmit'])) {
           //gets the groupID, removes the slash, replaces it with a space, then removes the space.
           $git       = $_POST['git'];
           $repoName  = $_POST['repoName'];
           $reposlash = str_replace('/', ' ', $repoName);
           $repoName  = trim($reposlash);
           $repocheck = mysql_query("SELECT repo_id FROM repo WHERE name ='" . $repoName . "' and git ='" . $git . "';");
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
                                                 <input type='hidden' name='git' value='" . $git . "' /> 
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
                                     <input type='hidden' name= 'name' value ='" . $reponame . "'/> </form>";
           $_SESSION['RepoAlterSuccess'] = true;
           echo "<script>confirmation();</script>";
       }
   }
   $view['slots']->stop();
   ?>