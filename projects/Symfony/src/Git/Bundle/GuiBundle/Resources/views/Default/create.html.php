<?php 
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
    $view->extend('GitGuiBundle:Default:base.html.php');
    $view['slots']->start('title');
	session_start();
	if ($_SESSION['LoggedIn'] !== TRUE) {
   header("Location:login");

   exit();
}
  if (isset($_SESSION['Alert']) && $_SESSION['Alert'] == TRUE){
   ?> 
   <div class="span12 pagination-centered">
       <div class="alert alert-block alert-error fade in">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Oh snap! You got an error!</h4>
            <p>You have entered an incorrect username! Try again!</p>
   
          </div>
<?php }?>

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
            <button type="Submit" name ="Submit" class="btn">Submit</button>
         </fieldset>
      </form>

<?php
	
   $userInfo = mysql_query("SELECT * FROM user;");
   if (!$userInfo) {
     die("<p>Error in listing users " . mysql_error() . "</p>");
   }
   

   echo "<table class='table table-hover'>
   <tr>
   <th>First Name</th>
   <th>Last Name</th>
   <th>User Name</th>
   <th>Email </th>
   <th>Delete?</th>
   </tr>";
   
   while($row = mysql_fetch_array($userInfo))
   {
   echo" <form action='add' method='POST'> 
       <input type='hidden' name='step' value='5' /> 
       <input type ='hidden' name ='username'  id ='username' value ='".$row['username']."'/>";
   echo "<tr>";
   echo "<td> {$row['first_name']} </td>" ;
   echo "<td> {$row['last_name']} </td>";
   echo "<td> {$row['username']} </a> </td>";
   echo "<td> {$row['email']} </td>";
   echo "<td> <button class='btn btn-danger' type='submit'>Delete</td> ";
   echo "</tr>";
   echo "</form>";
   }
   echo "</table> </div></div>";
   $view['slots']->stop();
   ?>
