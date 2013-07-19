<?php
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
   $view->extend('GitGuiBundle:Default:base.html.php');
   $view['slots']->start('title');
   session_start();
   $_SESSION['Success'] = false;
   if ($_SESSION['LoggedIn'] !== TRUE) {
       header("Location:login");
       exit();
   }
   if (isset($_SESSION['Alert']) && $_SESSION['Alert'] == TRUE) {
   ?> 
<div class="span8 offset3">
   <div class="alert alert-block alert-error fade in">
      <button type="button" name="close" class="close" data-dismiss="alert" onClick="disable()">&times;</button>
      <h4 class="alert-heading">Error!</h4>
      <p>You have entered an incorrect username! Try again!</p>
   </div>
</div>
<?php
   }
   ?>
<div class='row-fluid'>
<div class='span8 offset2'>
<?php
   if (isset($_SESSION['CreateSuccess']) && $_SESSION['CreateSuccess'] == TRUE) {
   ?> 
<div class="span8">
   <div class="alert alert-block alert-success fade in">
      <button type="button" name="close" class="close" data-dismiss="alert" onclick="disable()">&times;</button>
      <h4 class="alert-heading">Update Successfully</h4>
      <p>You Have Successfully Updated The Database</p>
   </div>
</div>
<?php
   }
   ?>    
<form action="add" method="POST">
   <fieldset >
      <legend>Create User</legend>
      <input type='hidden' name='step' value='2' />
      <label for='username' >UserName*:</label>
      <input type='text' name='username' id='username' required  maxlength="50" />
      <br/>
      <input type="radio" name="userType" value="user" checked>User
      <input type="radio" name="userType" value="manager">Manager
      </br>
      <br/> 
      <button type="Submit" name ="Submit" class="btn">Submit</button>
   </fieldset>
</form>
<fieldset>
<legend> Search Current Users </legend>
<?php
   $userInfo = mysql_query("SELECT * FROM user ORDER BY first_name;");
   if (!$userInfo) {
       die("<p>Error in listing users " . mysql_error() . "</p>");
   }
   echo "<input type='text' id='txtSearch' onkeyup='Search()' placeholder='Type to search'>";
   echo "<table class='table table-hover' id= 'table'>
            <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>User Name</th>
            <th>Email </th>
            <th>Type </th>
            <th>Delete?</th>
            </tr>";
   while ($row = mysql_fetch_array($userInfo)) {
       echo " <form action='' method='POST'>
                <input type='hidden' name='username' value='" . $row['username'] . "' />";
       echo "<tr>";
       echo "<td> {$row['first_name']} </td>";
       echo "<td> {$row['last_name']} </td>";
       echo "<td> {$row['username']} </a> </td>";
       echo "<td> {$row['email']} </td>";
       if ($row['manager'] == 1) {
           echo "<td> Manager </td>";
       } else {
           echo "<td> User </td>";
       }
       echo "<td><button class='btn btn-danger btn-small' name = 'delete' value ='delete' type='submit'>Delete</td> ";
       echo "</tr> </form>";
   }
   echo "</table> </fieldset></div></div>";
   if (isset($_POST['delete'])) {
       echo "<script>show();</script>";
       $username = $_REQUEST['username'];
       echo "<form action='add' method='POST' id ='deleteUser'>
    		<input type='hidden' name='step' value='5' />
                <input type='hidden' name='username' value='" . $username . "' /></form>";
   }
   ?>
<?php
   $view['slots']->stop();
   ?>