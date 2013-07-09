<?php
 require_once('scripts/ldap.php');
   require_once('scripts/database.php');
    $view->extend('GitGuiBundle:Default:base.html.php');
    $view['slots']->start('title');
   
   
   ?>
   <div class='row-fluid'>
<div class='span8 offset2'>

<h3> Create a New Group </h3>	
<form action="groupadd" method="POST">
<input type='hidden' name='step' value='1' />
Group Name: <input type="text" name="groupname" required><br>	

<input type='submit' name='Submit' value='Submit' />
</form>

  <form action="show" method="POST">
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
         
    </ul>
</div>
 </div>       

       <input type='submit' name='Submit' value='Submit' />
      



 <?php $view['slots']->stop();?> 
