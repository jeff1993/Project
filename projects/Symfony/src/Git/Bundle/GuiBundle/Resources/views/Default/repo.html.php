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
            <button type="Submit" name ="Submit" class="btn">Submit</button>
         </fieldset>
         <br/>
      </form>
      <form action="show" method="POST">
         <fieldset >
            <legend>Manage Repo</legend>
            <input type='hidden' name='step' value='3' /> 
            <select name="repoDropDown">
            <?php
               $result = mysql_query("SELECT name FROM repo ORDER BY name");
               
               if (!$result) {
                   die("<p>Error in listing tables: " . mysql_error() . "</p>");
               }
               
               echo "<p>Tables in database:</p>";
               while ($row = mysql_fetch_row($result)) {
                   echo "<option value ={$row[0]}>" . $row[0] . " </option>";
               }
               
               ?>
            </select>
            <br/>
            <br/>
         </fieldset>
         <button type="Submit" name ="Submit" class="btn">Submit</button>
      </form>
   </div>
</div>
<?php $view['slots']->stop();?>