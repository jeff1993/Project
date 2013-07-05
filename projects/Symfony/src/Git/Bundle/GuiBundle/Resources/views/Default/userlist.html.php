

<!DOCTYPE html>  
	<html lang="en">  
		<head>
			<meta charset="utf-8" />  
			<title>User List</title>  

<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
		
		
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
  $con=mysql_connect("localhost", 
                "root", "tucker24")
    or die("<p>Error connecting to database: " . 
           mysql_error() . "</p>");

 
  
  mysql_select_db("Test")
    or die("<p>Error selecting the database your-database-name: " .
           mysql_error() . "</p>");

  
  $result = mysql_query("SELECT * FROM user;");
  
  $show =  "show";

  if (!$result) {
    die("<p>Error in listing users " . mysql_error() . "</p>");
  }

$size="span12 pagination-centered";

echo"<div class='".$size."'>";

  
  echo "<table border='1'>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>User Name</th>
<th>Email </th>
<th>View </th>
<th>Delete?</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo" <form action='show' method='POST'> 
      <input type='hidden' name='step' value='4' /> 
      <input type ='hidden' name ='username'  id ='username' value ='".$row['username']."'/>";
  echo "<tr>";
  echo "<td> {$row['first_name']} </td>" ;
  echo "<td> {$row['last_name']} </td>";
  echo "<td> {$row['username']} </a> </td>";
  echo "<td> {$row['email']} </td>";
  echo "<td><input type='submit' name='view' value='view'/></td>";
  echo "<td><input type='submit' name='delete' value='delete'/></td>";
  echo "</tr>";
  echo "</form>";
  }
echo "</table> </div>";
  
  
?>




</body>
</html>

