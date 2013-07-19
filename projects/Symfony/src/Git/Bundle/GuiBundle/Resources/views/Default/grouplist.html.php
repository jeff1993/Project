<?php
   require_once('scripts/ldap.php');
     require_once('scripts/database.php');
     session_start();
      $_SESSION['Alert'] = false;
      $_SESSION['Success'] = false;
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
         <input type='text' id='txtSearch' onkeyup='Search()' placeholder='Type to search'>
         <?php
            $groupInfo = mysql_query("SELECT * FROM groups ORDER BY name;");
            if (!$groupInfo) {
            die("<p>Error in listing users " . mysql_error() . "</p>");
            }
            
            echo "<table class='table table-condensed table-hover' id ='table'>
            <tr>
            <th>Group Name</th>
            <th>Edit</th> 
            <th>Delete?</th>
            </tr>";
            
            while($row = mysql_fetch_array($groupInfo))
            {
            echo " <form action='' method='POST'> 
            <input type='hidden' name='step' value='1' /> 
            <input type='hidden' name= 'name' value ='".$row['name']."'/>";
            
            echo "<tr>";
            echo "<td> {$row['name']} </td>" ;
            
            echo "<td><button class='btn btn-warning btn-small' name = 'edit' id ='edit' value ='edit' type='submit'>Edit</td> ";
            echo "<td><button class='btn btn-danger btn-small' name = 'delete' id ='delete' value ='delete' type='submit'>Delete</td> ";
            echo "</tr>";
       		echo "</form>";
            }
            
            echo "</table> </div></div>";
                        
    
            if(isset($_POST['edit'])){
            $name = $_REQUEST['name'];
            echo "
            <form action='show' method='POST' id ='deleteUser'> 
            <input type='hidden' name='step' value='1' /> 
            <input type='hidden' name= 'name' value ='".$name."'/> </form>";
			echo "<script>confirmation();</script>";
            }
            
            if (isset($_POST['delete'])) {
       echo "<script>show();</script>";
       $name = $_REQUEST['name'];
       echo "<form action='add' method='POST' id ='deleteUser'>
    		<input type='hidden' name='step' value='8' />
                <input type='hidden' name='name' value='" . $name . "' /></form>";
   }
            
            
            ?>   
      </fieldset>
   </div>
</div>
<?php $view['slots']->stop();?>