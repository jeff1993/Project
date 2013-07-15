<?php
   require_once('scripts/ldap.php');
     require_once('scripts/database.php');
     session_start();
     if ($_SESSION['LoggedIn'] !== TRUE) {
   header("Location:login");
   
   exit();
   }
      $view->extend('GitGuiBundle:Default:base.html.php');
      $view['slots']->start('title');
      
      ?>
<div class='row-fluid'>
   <div class='span8 offset2'>
      <form action="managerepo" method="POST">
         <fieldset >
            <legend>Create a New Repository</legend>
            <input type='hidden' name='step' value='1' />
            <label for='reponame' >Repository Name*:</label>
            <input type='text' name='reponame' id='reponame'  maxlength="50" />
            <br/> 
            <input type="radio" name="repoType" value="git">Git
            <input type="radio" name="repoType" value="svn">Svn
            </br>
            </br>
            <button type="Submit" name ="Submit" class="btn">Submit</button>
         </fieldset>
         <br/>
      </form>
      <fieldset >
         <legend>Manage Repo</legend>
         <input type="text" id="search" placeholder="Type to search">
         <?php
            $repoInfo = mysql_query("SELECT * FROM repo ORDER BY name;");
            if (!$repoInfo) {
            die("<p>Error in listing users " . mysql_error() . "</p>");
            }
            
            
            echo "<table class='table table-condensed table-hover' id ='table'>
            <tr>
            <th>Repo Name</th>
            
            <th>Edit</th> 
            <th>Delete?</th>
            </tr>";
            
            while($row = mysql_fetch_array($repoInfo))
            {
            echo" <form action='show' method='POST' id ='deleteUser'> 
            <input type='hidden' name='step' value='3' /> 
            <input type ='hidden' name ='repoName'  id ='repoName' value ='".$row['name']."'/>";
            echo "<tr>";
            echo "<td> {$row['name']} </td>" ;
            echo "<td> <button class='btn btn-warning btn-small' name = 'action' value ='edit' type='submit'>Edit</td> ";
            echo "<td><a href='#myModal' role='button' class='btn btn-danger btn-small' data-toggle='modal'>Delete</a></td> ";
            echo "</tr>";
            echo "</form>";        
            }
            echo "</table> </div></div>";
            ?>   
      </fieldset>
   </div>
</div>
<script>
   var $rows = $('#table tr');
   $('#search').keyup(function() {
       var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
   
       $rows.show().filter(function() {
           var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
           return !~text.indexOf(val);
       }).hide();
   });
</script>
<?php $view['slots']->stop();?>