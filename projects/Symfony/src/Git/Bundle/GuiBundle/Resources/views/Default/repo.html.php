<?php
 require_once('scripts/ldap.php');
   require_once('scripts/database.php');
    $view->extend('GitGuiBundle:Default:base.html.php');
    $view['slots']->start('title');
    ?>
      
      <div class="span12 pagination-centered">
         <form action="managerepo" method="POST">
            <fieldset >
               <legend>Create a New Repository</legend>
               <input type='hidden' name='step' value='1' />
               <label for='reponame' >Repository Name*:</label>
               <input type='text' name='reponame' id='reponame'  maxlength="50" />
               <br/> 
                 <input type='submit' name='Submit' value='Submit' />
            </fieldset>
               <br/>
           
         </form>
      </div>
      
      
       <form action="show" method="POST">
            <fieldset >
               <legend>Assign Repositories</legend>  
               <input type='hidden' name='step' value='2' /> 
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
         
     <form action="show" method="POST"> 
      <input type='hidden' name='step' value='2' />    
    <div class="btn-group">
  <button class="btn btn-primary" data-label-placement>Checked option</button>
  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
    <ul class="dropdown-menu text-center">
    <?php

$repo = "Select name from repo";


$query_resource = mysql_query($repo);
//Iterate over the results that you've gotten from the database
while ($reponame = mysql_fetch_assoc($query_resource)) {
    
    echo " <li><input type='checkbox' id=" . $reponame['name'] . " name='repo[]' value=" . $reponame['name'] . "><label for=" . $reponame['name'] . ">" . $reponame['name'] . "</label></li>";
    
}

?>

    </ul>
</div>
        

       <input type='submit' name='Submit' value='Submit' />
      
      </form>
      
       <form action="show" method="POST">
            <fieldset >
               <legend>Manage Repo</legend>  
               <input type='hidden' name='step' value='3' /> 
               <select name="groupdropdown">
               
               <?php


$result = mysql_query("Select name from repo");

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
                
      <input type='submit' name='Submit' value='Submit' />
      
         </form>
         
      
     <?php $view['slots']->stop();?> 



