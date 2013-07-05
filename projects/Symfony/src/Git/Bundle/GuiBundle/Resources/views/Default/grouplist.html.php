<!DOCTYPE html>  
	<html lang="en">  
		<head>
			<meta charset="utf-8" />  
			<title>Group List</title>  

<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
		</head>
		
		
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
	
	
				<div class="navbar ">
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

<div class="span12 pagination-centered">
<h3> Create a New Group </h3>	
<form action="groupadd" method="POST">
<input type='hidden' name='step' value='1' />
Group Name: <input type="text" name="groupname"><br>	

<input type='submit' name='Submit' value='Submit' />
</form>
	


<form action="show" method="POST">
<fieldset >
<legend>View Users in Groups/Edit Permissions</legend>
<input type='hidden' name='step' value='1' /> 
 
<br/> 
 
<select name="mydropdown">

<?php
mysql_connect("localhost", "root", "tucker24") or die("<p>Error connecting to database: " . mysql_error() . "</p>");
mysql_select_db("Test") or die("<p>Error selecting the database your-database-name: " . mysql_error() . "</p>");
$result = mysql_query("Select name from groups");
if (!$result) {
    die("<p>Error in listing tables: " . mysql_error() . "</p>");
}
echo "<p>Tables in database:</p>";
while ($row = mysql_fetch_row($result)) {
    echo "<option value ={$row[0]}>" . $row[0] . " </option>";
}
?>

</select>

<br/>
 
<input type='submit' name='Submit' value='Submit' />
 </div>
</fieldset>
</form>

  <form action="groupadd" method="POST">
            <fieldset >
               <legend>Assign Users</legend>  
               <input type='hidden' name='step' value='1' /> 
               <select name="groupdropdown">
               
               <?php
$result = mysql_query("Select name from groups");
if (!$result) {
    die("<p>Error in listing tables: " . mysql_error() . "</p>");
}
echo "<p>Tables in database:</p>";
while ($row = mysql_fetch_row($result)) {
    echo "<option value ={$row[0]}>" . $row[0] . " </option>";
}
?>
                
              
               <br/>
               <br/>       
            </fieldset>
      
         </form>
         
     <form action="show" method="POST"> 
      <input type='hidden' name='step' value='2' />    
    <div class="btn-group">
  <button class="btn btn-primary" data-label-placement>Check Users</button>
  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
    <ul class="dropdown-menu text-center">
    <?php
$user           = "Select username from user";
$query_resource = mysql_query($user);
//Iterate over the results that you've gotten from the database
while ($username = mysql_fetch_assoc($query_resource)) {
    echo " <li><input type='checkbox' id=" . $username['username'] . " name='user[]' value=" . $username['username'] . "><label for=" . $username['username'] . ">" . $username['username'] . "</label></li>";
}
?>

    </ul>
</div>
        

       <input type='submit' name='Submit' value='Submit' />
      




</body>
</html>

