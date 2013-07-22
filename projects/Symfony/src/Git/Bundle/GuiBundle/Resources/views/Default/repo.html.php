<?php
   require_once('scripts/ldap.php');
   require_once('scripts/database.php');
   session_start();
   $_SESSION['Alert']   = false;
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
            echo "<table class='table table-condensed table-hover' id ='table'>
                                                <tr>
                                                <th>Repo Name</th>  
                                                <th>Type </th>  
                                                <th>Edit</th> 
                                               <th>Delete?</th>
                                                </tr>";
            while ($row = mysql_fetch_array($repoInfo)) {
                echo " <form action='' method='POST'> 
                               <input type='hidden' name= 'name' value ='" . $row['name'] . "'/>";
                echo "<tr>";
                echo "<td> {$row['name']} </td>";
                if ($row['git'] == 1) {
                    echo "<td> Git </td>";
                } else {
                    echo "<td> Svn </td>";
                }
                echo "<td><button class='btn btn-warning btn-small' name = 'edit' id ='edit' value ='edit' type='submit'>Edit</td> ";
                echo "<td><button class='btn btn-danger btn-small' name = 'delete' id ='delete' value ='delete' type='submit'>Delete</td> ";
                echo "</tr>";
                echo "</form>";
            }
            echo "</table> </div></div>";
            if (isset($_POST['edit'])) {
                $name = $_REQUEST['name'];
                echo "<form action='show' method='POST' id ='deleteUser'> 
                    <input type='hidden' name='step' value='3' /> 
                     <input type='hidden' name= 'name' value ='" . $name . "'/> </form>";
                echo "<script>confirmation();</script>";
            }
            if (isset($_POST['delete'])) {
                echo "<script>show();</script>";
                $name = $_REQUEST['name'];
                echo "<form action='add' method='POST' id ='deleteUser'>
                 <input type='hidden' name='step' value='9' />
                <input type='hidden' name='name' value='" . $name . "' /></form>";
            }
            ?>
      </fieldset>
   </div>
</div>
<?php
   $view['slots']->stop();
   ?>