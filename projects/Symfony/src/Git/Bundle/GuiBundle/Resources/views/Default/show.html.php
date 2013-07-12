<?php
   $view->extend('GitGuiBundle:Default:base.html.php');
     $view['slots']->start('title');
   require_once('scripts/database.php');
   
   //value passed from group list page
   //shows each of the users that are assigned to the groups
   if ($_POST['step'] == 1)
   {
   	//gets the group name from the drop down in the groups list page
     $event = $_POST["groupName"];
       ?>
       <div class="row-fluid">
  		<div class="span4">
  		<div class="span4 offset2">
  <?php
     echo "<h1>" . $event . "</h1> </div> </div> </div>";
     
   
   ?>
   <!--From here till the end bracket is where you where we create the dual list view
   that you can assign users to the individual groups-->
<div class='row-fluid'>
<div class='span8 offset2'>
   <form  method="post" action="add" >
      <div>
         <input type='hidden' name='step' id='step' value='1'/>
         <?php echo "<input type='hidden' name='groupname' id='groupname' value=' ".$event." '/>";?>
      </div>
      <div>
         <table>
            <tr>
               <td>
                  <legend>All Users </legend>
                  <br/>
                  Filter: <input type="text" id="box1Filter" /><button type="button" class='btn btn-small'id="box1Clear">X</button><br />
                  <select id="box1View" name="box1View[]" multiple="multiple" style="height:500px;width:300px;">
                  <?php
                     $result = mysql_query("SELECT * FROM user ORDER BY username;");
                     while($row = mysql_fetch_array($result)){
                     echo "<option id='" . $row['username'] . "' name='box1View[]'  value='".$row['username']."'> ".$row['username']."</option>";
                     
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
                  <legend>Users Currently in <?php echo  $event ?> </legend>
                  <br/>
                  Filter: <input type="text" id="box2Filter" /><button type="button" class='btn btn-small' id="box2Clear">X</button><br />
                  <select id="box2View" name="box2View[]" multiple="multiple" style="height:500px;width:300px;">
                  <?php
                     $num2 = mysql_query("Select group_id from groups WHERE name ='" . $event . "';");
                     while ($row1 = mysql_fetch_row($num2))
                     {
                     $group_id = $row1[0];
                     }
                     
                     $perm = mysql_query("Select * from groups WHERE name ='" . $event . "';");
                     
                     $result = mysql_query("SELECT userID FROM group_management WHERE groupID = '" . $group_id . "';");
                     
                       while ($row1 = mysql_fetch_row($result))
                     {
                     $name = $row1[0];
                     
                     $username = mysql_query("SELECT * FROM user WHERE user_id = '" . $name . "' ORDER BY username;");
                     while ($row = mysql_fetch_array($username))
                     {
                     echo "<option id='" . $row['username'] . "' name='box2View[]'  value='".$row['username']."'> ".$row['username']."</option>";
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
   if ($_POST['step'] == 2)
   {
     	$name      = $_REQUEST['groupdropdown'];
       $groupname = str_replace('/', ' ', $name);
       $event      = trim($groupname);
        
       $num2= mysql_query("Select group_id from groups WHERE name ='".$event."';");
        while ($row1 = mysql_fetch_row($num2)) {
      		$group_id=$row1[0];
       }
   	
   	
   	$check =mysql_query("Select repoID from repo_management WHERE groupID ='".$event."';");
   
       foreach ($_POST['repo'] as $checkbox) {
     
           $reposlash  = $checkbox;
      		$groupname = str_replace('/', ' ', $reposlash);
       	$checkbox = trim($groupname);
       	 echo $checkbox;
       	 
           $sql = "Select repo_id from repo WHERE name ='" . $checkbox . "';";
           $check  = mysql_query($sql);
       	
           while ($row1 = mysql_fetch_row($check)) {
      		$repo_id=$row1[0];
      		}
   
      		
      		$exists =mysql_query("Select * from repo_management where groupID='".$group_id."' and repoID='".$repo_id."';");
      		
      		if($row =mysql_fetch_array($exists)){
     
      			$read = $row['perm_read'];
      			$write = $row['perm_write'];
      			$manage = $row['perm_manage'];
   
      		 $sql = "UPDATE repo_management SET  perm_read ='" . $read . "',
   perm_write ='" . $write . "',
   perm_manage ='" . $manage . "'
    WHERE groupID='" . $group_id . "' AND repoID ='".$repo_id."';";
               $check = mysql_query($sql) or die(mysql_error());
      		
   
      		}
      		
      		else {
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
   
    $name      = $_POST['repoName'];
       $groupname = str_replace('/', ' ', $name);
       $event      = trim($groupname);
        
       $num2= mysql_query("Select repo_id from repo WHERE name ='".$event."';");
        while ($row1 = mysql_fetch_row($num2)) {
      		$repo_id=$row1[0];
       }
       ?>
       <div class="row-fluid">
  		<div class="span4">
  		<div class="span4 offset2">
  <?php
     echo "<h1>" . $event . "</h1> </div> </div> </div>";
     $repo= mysql_query("SELECT repo_id FROM repo WHERE name ='".$event."';");
      while($row = mysql_fetch_row($repo)){
      $repo_id = $row[0];
      }
   
   ?>
    <!--From here  till the end of collapseOne is where you where we create the dual list view
   that you can assign groups to the individual repositories-->
<div class="accordion" id="accordion2">
<div class="accordion-group">
<div class="accordion-heading">
   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
   Assign Groups to Repos
   </a>
</div>
<div id="collapseOne" class="accordion-body collapse in">
   <div class="accordion-inner">
      <div class='row-fluid'>
         <div class='span8 offset2'>
            <form  method="post" action="add" >
               <div>
                  <input type='hidden' name='step' id='step' value='4'/>
                  <?php echo "<input type='hidden' name='repoName' id='repoName' value=' ".$event." '/>";?>
               </div>
               <div>
                  <table>
                     <tr>
                        <td>
                           <legend>All Groups</legend>
                           <br/>
                           Filter: <input type="text" id="box1Filter" /><button type="button" class='btn btn-small' id="box1Clear">X</button><br />
                           <select id="box1View" name="box1View[]" multiple="multiple" style="height:500px;width:300px;">
                           <?php
                           
                           
                           
                              $groups = mysql_query("SELECT * FROM groups ORDER BY name;");
                              while($row = mysql_fetch_array($groups)){
                              echo "<option id='" . $row['name'] . "' name='box1View[]'  value='".$row['name']."'> ".$row['name']."</option>";
                              
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
                           <legend>Users Currently in <?php echo  $event ?> </legend>
                           <br/>
                           Filter: <input type="text" id="box2Filter" /><button type="button"  class='btn btn-small' id="box2Clear">X</button><br />
                           <select id="box2View" name="box2View[]" multiple="multiple" style="height:500px;width:300px;">
                           <?php
                              $getGroupID = mysql_query("Select groupID from repo_management WHERE repoID ='" . $repo_id . "';");
                              while ($row1 = mysql_fetch_array($getGroupID))
                              {
                              $group_id = $row1[0];
                              
                              
                              $getGroupName = mysql_query("Select name FROM groups WHERE group_id ='" . $group_id . "';");
                              
                              $result = mysql_query("SELECT userID FROM group_management WHERE groupID = '" . $group_id . "' ORDER BY name;");
                              
                              
                              while ($row = mysql_fetch_array($getGroupName))
                              {
                              echo "<option id='" . $row['name'] . "' name='box2View[]'  value='".$row['name']."'> ".$row['name']."</option>";
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
</div>
<div class="accordion-group">
<div class="accordion-heading">
   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
    Adjust Group Permissions
   </a>
</div>
<!--CollapseTwo is about showing the permissions that each of the groups have to that repository
it will dynamically display what options are checked for each group. Then you can alter them beneath the 
dual list view of groups to repos. The changes are submitted to add.html.php with the value of Step 3-->
<div id="collapseTwo" class="accordion-body collapse">
<div class="accordion-inner">
<?php  
   $check =mysql_query("Select groupID from repo_management WHERE repoID ='".$repo_id."';");
   
   while ($row = mysql_fetch_row($check)) {
   	$group_id=$row[0];
   }
   	               	    
   	    
   	      echo "<table class='table table-bordered'>
   <tr>
   <th>Group Name</th>
   <th>Read</th>
   <th>Write</th>
   <th>Manage</th>
   <th> Update</th>
   </tr>";
   	    
   	    
   $perm =mysql_query("Select * from repo_management WHERE repoID ='".$repo_id."';");
   while ($row = mysql_fetch_array($perm))
   {
   	
   	//echo $row['groupID'];
   	$group = mysql_query("Select name from groups where group_id ='".$row['groupID']."';");
   	while ($row3 = mysql_fetch_row($group)) {
   	$group_name=$row3[0];
   	
   }
   
       echo "<form action='add' method='POST'>
   <input type='hidden' name='step' value='3' />
   <input type='hidden' name='submitted' id='submitted' value=" . $event . "/>
   <input type= 'hidden' name ='groupName' id =groupName' value=". $group_name."/>";
     echo "<tr>";
     echo "<td>".$group_name."</td>";
       if ($row['perm_read'] == 1)
       {
           echo "<td>	<input type='checkbox' class='form' value='read' checked name='checkbox[]' /> Read</td>";
           
       }
       else
       {
           echo "<td><input type='checkbox' class='form' value='read' name='checkbox[]' /> Read</td>";
       }
       if ($row['perm_write'] == 1)
       {
           echo "<td>	<input type='checkbox' class='form' value='write' checked name='checkbox[]' /> Write</td>";
           
       }
       else
       {
           echo "<td>	<input type='checkbox' class='form' value='write' name='checkbox[]' /> Write </td>";
       }
       if ($row['perm_manage'] == 1)
       {
           echo "<td>	<input type='checkbox' class='form' value='manage' checked name='checkbox[]' /> Manage</td>";
           
       }
       else
       {
           echo "<td>	<input type='checkbox' class='form' value='manage' name='checkbox[]' /> Manage</td>";
       }
      
       echo "<td><button type='Submit' name ='Submit' class='btn'>Submit</button> </td>";
        echo "</tr></form> </div> </div>";
   }   
  	echo" </table></div>
   </div> 
   </div> ";
   	}
   
   	?>
<?php 
   $view['slots']->stop()
   
   
   ?>