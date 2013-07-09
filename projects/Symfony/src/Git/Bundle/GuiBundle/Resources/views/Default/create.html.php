<?php 
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
    $view->extend('GitGuiBundle:Default:base.html.php');
    $view['slots']->start('title');
    
     ?>
<div class='row-fluid'>
<div class='span8 offset2'>
      <form action="add" method="POST">
         <fieldset >
            <legend>Create User</legend>
            <input type='hidden' name='submitted' id='submitted' value='1'/>
            <input type='hidden' name='step' value='2' />
            <label for='username' >UserName*:</label>
            <input type='text' name='username' id='username' required  maxlength="50" />
            <br/> 
            <input type='submit' name='Submit' value='Submit' />
         </fieldset>
      </form>

<?php
   $result = mysql_query("SELECT * FROM user;");
   if (!$result) {
     die("<p>Error in listing users " . mysql_error() . "</p>");
   }
   

   echo "<table class='table table-hover'>
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
   echo "</table> </div></div>";
   $view['slots']->stop();
   ?>
</body>
</html>