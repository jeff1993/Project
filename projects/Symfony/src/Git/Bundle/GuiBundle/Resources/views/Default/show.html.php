<!DOCTYPE html>  
	<html lang="en">  
		<head>
			<meta charset="utf-8" />  
			<title>User List</title>  

<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
		</head>
		
		
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
				
				<div class="navbar">
					<div class="navbar-inner">
						
						<ul class="nav">
							<li><a href="login">Home</a></li>
							<li><a href="#">About</a></li>
							
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Users <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
									<li><a href="user">Show All Users</a></li>
									<li><a href="create">Create Users</a></li>
									<li><a href="#">link</a></li>
									<li><a href="#">link</a></li>
								</ul>
								
							</li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Groups <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
                   				  <li><a href="group">Manage Groups</a></li>
                  				</ul>
								
							</li>
							 </li>
               <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Repos <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a href="repo">Manage Repositories</a></li>
                     <li><a href="../../../../../../../gitlist/index.php">View Repositories</a></li>
                  </ul>
               </li>
							
						</ul>
						
		
		</div>
	</div>
	
<?php



$con = mysql_connect("localhost", "root", "tucker24") or die("<p>Error connecting to database: " . mysql_error() . "</p>");


mysql_select_db("Test") or die("<p>Error selecting the database your-database-name: " . mysql_error() . "</p>");

if ($_POST['step'] == 1)
{
    $event = $_POST["mydropdown"];
    
    $num2 = mysql_query("Select group_id from groups WHERE name ='" . $event . "';");
    while ($row1 = mysql_fetch_row($num2))
    {
        $group_id = $row1[0];
    }
    
    
    
    
    echo "<h1>" . $event . "</h1>";
    $perm = mysql_query("Select * from groups WHERE name ='" . $event . "';");
    
    $result = mysql_query("SELECT userID FROM group_management WHERE groupID = '" . $group_id . "';");
         
    echo" <form action='add' method='POST'> 
      <input type='hidden' name='step' value='1' /> 
      <input type ='hidden' name ='groupID'  id ='groupID' value ='".$event."'/>";
    echo "<table border='1'>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>User Name</th>
<th>Email </th>
<th> Delete?</th>
</tr>";
    while ($row1 = mysql_fetch_row($result))
    {
        $name = $row1[0];
        
        $username = mysql_query("SELECT * FROM user WHERE user_id = '" . $name . "';");
        while ($row = mysql_fetch_array($username))
        {
            echo "<tr>";
            echo "<td> {$row['first_name']} </td>";
            echo "<td> {$row['last_name']} </td>";
            echo "<td> {$row['username']} </td>";
            echo "<td> {$row['email']} </td>";
            echo "<td><input type='submit' name='delete' value='delete'/></td>";
            echo "</tr>";
           
        }
    }
    
    echo "</table> </div>";
    echo "</form>";
}

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






?>





</body>
</html>