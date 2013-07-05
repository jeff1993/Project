<?php 
   $newuser = $_COOKIE["TestUser"];
   $newpass = $_COOKIE["TestPass"];
   
   $ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269")
   	or die("Could not connect to LDAP server.");
   	
   
   $basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";
   
   $dsb = ldap_bind($ds, $newuser, $newpass);

   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Git Gui</title>
      <!-- Bootstrap -->
      <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
   </head>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <script src="js/bootstrap.js"></script>
   <?php foreach ($view['assetic']->javascripts(
    array('@GitGuiBundle/Resources/public/js/*')
) as $url): ?>
    <script type="text/javascript" src="<?php echo $view->escape($url) ?>"></script>
<?php endforeach; ?>
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
         <form action="add" method="POST">
            <fieldset >
               <legend>Add User to Group</legend>
               <input type='hidden' name='submitted' id='submitted' value='1'/>
               <input type='hidden' name='step' value='2' />
               <label for='username' >UserName*:</label>
               <input type='text' name='username' id='username'  maxlength="50" />
               <br/> 
               <select name="mydropdown">
               <?php
          
                  mysql_connect("localhost", 
                                "root", "tucker24")
                    or die("<p>Error connecting to database: " . 
                           mysql_error() . "</p>");
                  
                  
                  mysql_select_db("Test")
                    or die("<p>Error selecting the database your-database-name: " .
                           mysql_error() . "</p>");
                  
                  $result = mysql_query("Select name from groups");
                  
                  if (!$result) {
                    die("<p>Error in listing tables: " . mysql_error() . "</p>");
                  }
                  
                  echo "<p>Tables in database:</p>";
                  while ($row = mysql_fetch_row($result)) {
                    echo "<option value ={$row[0]}>".$row[0]." </option>";
                  }
                  
                  ?>
               </select>
               <br/>
               <input type='submit' name='Submit' value='Submit' />
            </fieldset>
         </form>
      </div>
   </body>
</html>