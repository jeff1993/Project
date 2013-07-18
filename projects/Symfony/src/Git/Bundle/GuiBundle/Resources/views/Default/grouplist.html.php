<?php
   require_once('scripts/ldap.php');
     require_once('scripts/database.php');
     session_start();
      $_SESSION['Alert'] = false;
     if ($_SESSION['LoggedIn'] !== TRUE) {
   header("Location:login");
   
   exit();
   }
      $view->extend('GitGuiBundle:Default:base.html.php');
      $view['slots']->start('title');
     
     
     ?>
<div class='row-fluid'>
   <div class='span8 offset2'>
      <legend> Create a New Group </legend>
      <form action="groupadd" method="POST">
         <input type='hidden' name='step' value='1' />
         <label for='groupname' >Group Name*:</label>
         <input type="text" name="groupname" id='groupname' required><br>	
         <input type='submit' class= 'btn' name='Submit' value='Submit' />
      </form>
      <fieldset >
         <legend> All Groups </legend>
         <input type="text" id="search" placeholder="Type to search">
         <?php
            $groupInfo = mysql_query("SELECT * FROM groups ORDER BY name;");
            if (!$groupInfo) {
            die("<p>Error in listing users " . mysql_error() . "</p>");
            }
            echo" <form action='show' method='POST' id ='deleteUser'> 
            <input type='hidden' name='step' value='1' /> ";

            echo "<table class='table table-condensed table-hover' id ='table'>
            <tr>
            <th>Group Name</th>
            <th>Edit</th> 
            <th><a href='#myModal' role='button' name = 'delete' class='btn btn-danger btn-small' data-toggle='modal'>Delete</a></th>
            </tr>";
            
            while($row = mysql_fetch_array($groupInfo))
            {
            
            echo "<tr>";
            echo "<td> {$row['name']} </td>" ;
            
            echo "<td> <button class='btn btn-warning btn-small' name = 'action' value ='".$row['name']."' type='submit'>Edit</td> ";
            echo "<td> <input type='checkbox' name='deleteBox[]' value='".$row['name']."'</td>";
            echo "</tr>";
           
            }
             echo "</form>";
            echo "</table> </div></div>";
            ?>   
      </fieldset>
   </div>
</div>

<?php $view['slots']->stop();?>