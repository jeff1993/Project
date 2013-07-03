<?php
$newuser = $_COOKIE["TestUser"];
$newpass = $_COOKIE["TestPass"];

$ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269") or die("Could not connect to LDAP server.");


$basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";

$dsb = ldap_bind($ds, $newuser, $newpass);

mysql_connect("localhost", "root", "tucker24") or die("<p>Error connecting to database: " . mysql_error() . "</p>");


mysql_select_db("Test") or die("<p>Error selecting the database your-database-name: " . mysql_error() . "</p>");



?>
<!DOCTYPE html>
<html>
   <head>
      <title>Git Gui</title>
      <!-- Bootstrap -->
      <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
   </head>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <script src="https://github.com/Acquisio/bootstrap-dropdown-checkbox/blob/master/js/bootstrap-dropdown-checkbox.js"></script>
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
               <li><a href="#">Log Out</a></li>
            </ul>
         </div>
      </div>
      
      <div class="span12 pagination-centered">
         <form action="managerepo" method="POST">
            <fieldset >
               <legend>Create a New Repository</legend>
               <input type='hidden' name='step' value='1' />
               <label for='reponame' >Repository Name*:</label>
               <input type='text' name='reponame' id='reponame'  maxlength="50" />
               <br/> 
                 <input type='submit' name='Submit' value='Submit' />
            </fieldset>
               <br/>
           
         </form>
      </div>
      
      
       <form action="show" method="POST">
            <fieldset >
               <legend>Assign Repositories</legend>  
               <input type='hidden' name='step' value='2' /> 
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
  <button class="btn btn-primary" data-label-placement>Checked option</button>
  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
    <ul class="dropdown-menu text-center">
    <?php

$repo = "Select name from repo";


$query_resource = mysql_query($repo);
//Iterate over the results that you've gotten from the database
while ($reponame = mysql_fetch_assoc($query_resource)) {
    
    echo " <li><input type='checkbox' id=" . $reponame['name'] . " name='repo[]' value=" . $reponame['name'] . "><label for=" . $reponame['name'] . ">" . $reponame['name'] . "</label></li>";
    
}

?>

    </ul>
</div>
        

       <input type='submit' name='Submit' value='Submit' />
      
      </form>
      
       <form action="show" method="POST">
            <fieldset >
               <legend>Manage Repo</legend>  
               <input type='hidden' name='step' value='3' /> 
               <select name="groupdropdown">
               
               <?php


$result = mysql_query("Select name from repo");

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
                
      <input type='submit' name='Submit' value='Submit' />
      
         </form>
         
      
      
   </body>
</html>


