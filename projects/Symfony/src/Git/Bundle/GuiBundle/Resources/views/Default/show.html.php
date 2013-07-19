<?php
   $view->extend('GitGuiBundle:Default:base.html.php');
   $view['slots']->start('title');
   require_once('scripts/database.php');
   //value passed from group list page
   //shows each of the users that are assigned to the groups
   if ($_POST['step'] == 1) {
       //gets the group name from the drop down in the groups list page
       // $event = $_POST["groupName"];
     
   ?>
<div class="row-fluid">
<div class="span4">
<div class="span4 offset2">
<?php
   $event = $_POST['name'];
   echo "<h1>" . $event . "</h1> </div> </div> </div>";
   $getGroupID = mysql_query("SELECT group_id FROM groups where name ='" . $event . "';");
   while ($row1 = mysql_fetch_array($getGroupID)) {
       $groupID = $row1['group_id'];
   }
   ?>
<!--From here till the end bracket is where you where we create the dual list view
   that you can assign users to the individual groups-->
<div class='row-fluid'>
<div class='span8 offset2'>
   <form  method="post" action="add" >
      <div>
         <input type='hidden' name='step' id='step' value='1'/>
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
      <button type='Submit' name ='Submit' class='btn'>Submit</button>
   </form>
</div>
<?php
   }
   
   //shows each of the groups that are assigned to each reposistory 
   if ($_POST['step'] == 2) {
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
   if ($_POST['step'] == 3) {
   if (!isset($_POST['action'])) {
       foreach ($_POST['deleteBox'] as $checkbox) {
           $delete_query = "DELETE FROM repo WHERE name ='" . $checkbox . "';";
           mysql_query($delete_query) or die(mysql_error());
       }
       header("Location: repo");
       exit();
   } else {
       $event = $_POST['action'];
       $num2  = mysql_query("Select repo_id from repo WHERE name ='" . $event . "';");
       while ($row1 = mysql_fetch_row($num2)) {
           $repo_id = $row1[0];
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
<div class="tabbable tabs-right">
<ul class="nav nav-tabs">
   <li class="active"><a href="#gR" data-toggle="tab">Assign Groups</a></li>
   <li><a href="#aR" data-toggle="tab">Adjust Groups Rights</a></li>
</ul>
<div class="tab-content">
   <div class="tab-pane active" id="gR">
      <div class='row-fluid'>
         <div class='span8'>
            <div class ="span3">
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
                  <form method = "post" action= "add">
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
                     <button type='Submit' name ='Submit' class='btn btn-small'>Submit</button>
               </div>
               </form>
            </div>
            <span class = "span3">
            <form  method="post" action="add" >
               <div>
                  <input type='hidden' name='step' id='step' value='4'/>
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
               <button type='Submit' name ='Submit' class='btn'>Submit</button>
            </form>
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
                   echo "<form action='add' method='POST'>
                <input type='hidden' name='step' value='3' />
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
                   echo "<td><button type='Submit' name ='Submit' class='btn'>Submit</button> </td>";
                   echo "</tr></form> </div> </div>";
               }
               echo " </table></div>
                </div> 
                </div> ";
               }
               }
               ?>
         </fieldset>
      </div>
   </div>
</div>
<?php
   $view['slots']->stop();
   ?>