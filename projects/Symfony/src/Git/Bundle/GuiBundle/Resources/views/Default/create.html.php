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
<script src="<?php echo $view['assets']->getUrl('js/jQuery.dualListBox-1.3.js') ?>" type="text/javascript" ></script>
<script language="javascript" type="text/javascript">

        $(function() {

            $.configureBoxes();

        });

    </script>
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
      
      
       <form name="form1" method="post" action="DLBPlugin.aspx" id="form1">

<div>

<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTk5MjI0ODUwOWRkJySmk0TGHOhSY+d9BU9NHeCKW6o=" />

</div>



    <div>

    <table>

            <tr>

                <td>

                        Filter: <input type="text" id="box1Filter" /><button type="button" id="box1Clear">X</button><br />

                        <select id="box1View" multiple="multiple" style="height:500px;width:300px;">
                        
                        
                        <?php
                        $result = mysql_query("SELECT * FROM user;");
                        while($row = mysql_fetch_array($result)){
                        echo "<option value=".$row['username']."> ".$row['username']."</option>";
                        
                        }
                        
                        
                        ?>



                        </select><br/>

                         <span id="box1Counter" class="countLabel"></span>

                       <select id="box1Storage">

                        </select>

                </td>

                <td>

                    <button id="to2" type="button">&nbsp;>&nbsp;</button>

                    <button id="allTo2" type="button">&nbsp;>>&nbsp;</button>

                    <button id="allTo1" type="button">&nbsp;<<&nbsp;</button>

                    <button id="to1" type="button">&nbsp;<&nbsp;</button>

                </td>

                <td>

                    Filter: <input type="text" id="box2Filter" /><button type="button" id="box2Clear">X</button><br />

                    <select id="box2View" multiple="multiple" style="height:500px;width:300px;">

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
    <?php
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