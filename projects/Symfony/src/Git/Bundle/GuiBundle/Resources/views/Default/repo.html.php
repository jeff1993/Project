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
      <form action="managerepo" method="POST">
         <fieldset >
            <legend>Create a New Repository</legend>
            <input type='hidden' name='step' value='1' />
            <label for='reponame' >Repository Name*:</label>
            <input type='text' name='reponame' id='reponame'  maxlength="50" />
            <br/> 
            <input type="radio" name="repoType" value="git" checked>Git
            <input type="radio" name="repoType" value="svn">Svn
            </br>
            </br>
            <button type="Submit" name ="Submit" class="btn">Submit</button>
         </fieldset>
         <br/>
      </form>
      <fieldset >
         <legend>Manage Repositories</legend>
           <input type='text' id='txtSearch' onkeyup='Search()' placeholder='Type to search'>
         <?php
            $repoInfo = mysql_query("SELECT * FROM repo ORDER BY name;");
            if (!$repoInfo) {
                die("<p>Error in listing users " . mysql_error() . "</p>");
            }
            echo " <form action='show' method='POST' id ='deleteUser'> 
                        <input type='hidden' name='step' value='3' />";
            echo "<table class='table table-condensed table-hover' id ='table'>
                        <tr>
                        <th>Repo Name</th>  
                        <th>Type </th>  
                        <th>Edit</th> 
                       <th><a href='#myModal' role='button' name = 'delete' class='btn btn-danger' data-toggle='modal'>Delete</a></th>
                        </tr>";
            while ($row = mysql_fetch_array($repoInfo)) {
                echo "<tr>";
                echo "<td> {$row['name']} </td>";
                if ($row['git'] == 1) {
                    echo "<td> Git </td>";
                } else {
                    echo "<td> Svn </td>";
                }
                echo "<td> <button class='btn btn-warning btn-small' name = 'action' value ='" . $row['name'] . "' type='submit'>Edit</td> ";
                echo "<td> <input type='checkbox' name='deleteBox[]' value='" . $row['name'] . "'</td>";
                echo "</tr>";
                echo "</form>";
            }
            echo "</table> </div></div>";
            ?>   
      </fieldset>
   </div>
</div>
<?php
   $view['slots']->stop();
   ?>