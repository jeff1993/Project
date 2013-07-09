 	
<?php
 
  $view->extend('GitGuiBundle:Default:base.html.php');
    $view['slots']->start('title');
	require_once('scripts/database.php');



//shows each of the users that are assigned to the groups
if ($_POST['step'] == 1)
{
    $event = $_POST["groupdropdown"];
    echo "<h1>" . $event . "</h1>";
    

  ?>
  <div class='row-fluid'><div class='span8 offset2'>
    <form  method="post" action="add" >

<div>

<input type='hidden' name='step' id='step' value='1'/>
<?php echo "<input type='hidden' name='groupname' id='groupname' value=' ".$event." '/>";?>

</div>



    <div>

    <table>

            <tr>

                <td>
						<h3>All Users </h3><br/>
                        Filter: <input type="text" id="box1Filter" /><button type="button" id="box1Clear">X</button><br />
						
                        <select id="box1View" name="box1View[]" multiple="multiple" style="height:500px;width:300px;">
    				<?php
    				
                        $result = mysql_query("SELECT * FROM user;");
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

                    <button id="to2" type="button"> > </button>
					<button id="allTo2" type="button"> >> </button>
					<button id="allTo1" type="button"> << </button>
					<button id="to1" type="button"> < </button>

                </td>

                <td>
					<h3>Users Currently in <?php echo  $event ?> </h3><br/>
                    Filter: <input type="text" id="box2Filter" /><button type="button" id="box2Clear">X</button><br />

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
        
       							 $username = mysql_query("SELECT * FROM user WHERE user_id = '" . $name . "';");
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
    
    <input type="submit" value="Submit" />

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
    echo "<input type='submit' name='Submit' value='Submit' />";
    




}


if ($_POST['step'] == 3) {



  	$name      = $_POST["groupdropdown"];
    $groupname = str_replace('/', ' ', $name);
    $event      = trim($groupname);
     
    $num2= mysql_query("Select repo_id from repo WHERE name ='".$event."';");
     while ($row1 = mysql_fetch_row($num2)) {
   		$repo_id=$row1[0];
    }
	
	
	$check =mysql_query("Select groupID from repo_management WHERE repoID ='".$repo_id."';");
	
	 while ($row = mysql_fetch_row($check)) {
   		$group_id=$row[0];
    }
   		
   		
   		    echo "<h1>" . $event . "</h1>";
   		    
   		    
   		      echo "<table border='1'>
<tr>
<th>Group Name</th>
<th>Read</th>
<th>Write</th>
<th>Manage</th>
<th> Update</th>
<th> Remove?</th>
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
       
        echo "<td><input type='submit' name='Submit' value='Submit' /> </td>";
        	echo "<td><input type='submit' name='Delete' value='Delete' /> </form> <br/></td>";
        
    }    echo "</table> </div>";
   		
   
   		
   		

   		}
   		if ($_POST['step'] == 4) {
   		
   			$name  = $_POST["username"];
   			echo "<h1>".$name."</h1>";
   		
   		
   		if (isset($_POST['delete'])){
   		
 		 $delete_sql = "DELETE FROM user WHERE username='".$name."';";
        mysql_query($delete_sql) or die(mysql_error());
        
        header("Location: submitted");
        exit(); 
   		
   		
   		
   		}
   		else {


	$getUserID = mysql_query("SELECT user_id FROM user where username ='".$name."';");
	while($row1 = mysql_fetch_row($getUserID)){
		$userID = $row1[0];
		echo $userID;
	}
	
  $result = mysql_query("SELECT groupID FROM group_management where userID ='".$userID."';");
  
 
  
  
  if (!$result) {
    die("<p>Error in listing users " . mysql_error() . "</p>");
  }

$size="span12 pagination-centered";

echo"<div class='".$size."'>";

  
  echo "<table border='1'>
<tr>
<th>Group Name</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
	
	 $groupIDQuery = mysql_query("Select name from groups where group_id ='".$row['groupID']."';");
	 
	 while ($row2 =mysql_fetch_row($groupIDQuery)){
	 		$groupName = $row2[0];
	   echo "<tr>";
  echo "<td>".$groupName." </td>" ;

  echo "</tr>";
	 }


  }
echo "</table> </div>";
   		
   		
   		}
   		
   		
   		
   		}



$view['slots']->stop()


?>

