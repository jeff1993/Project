<?php

mysql_connect("localhost", "root", "tucker24") or die("<p>Error connecting to database: " . mysql_error() . "</p>");

mysql_select_db("Test") or die("<p>Error selecting the database your-database-name: " . mysql_error() . "</p>");




if ($_POST['step'] == 1) {


$reponame = $_REQUEST['reponame'];


$path = "/Users/jsimpson1271/Desktop";

chdir($path);

exec ("mkdir ".$reponame);
exec ("cd ".$reponame, $output, $return);
$path = "/Users/jsimpson1271/Desktop/".$reponame;

chdir($path);

exec("git init", $output, $return);

exec ("touch README", $output5, $return);

exec ("git add README", $output1, $return);

exec ("git commit -m 'first commit'", $output2, $return);

exec ("git remote add origin git@github.com:jeff1993/".$reponame.".git", $output3, $return5);

exec ("git push -u origin master", $output4, $return);


  
    
   $tester = mysql_query("Select name from repo WHERE name ='" . $reponame . "';");

  $num_results1 = mysql_num_rows($tester);
    
    if ($num_results1 == 0) { 
     
        $insert_sql = "INSERT INTO repo (name) " . "VALUES ('{$reponame}');";
        
        mysql_query($insert_sql) or die(mysql_error());
        
        header("Location: submitted");
        exit();
        
    }
    
    else {
        
        header("Location: repo");
        exit();
    }

}
if ($_POST['step'] == 2) {



  	$name      = $_POST["groupdropdown"];
    $groupname = str_replace('/', ' ', $name);
    $event      = trim($groupname);
     
    $num2= mysql_query("Select repo_id from repo WHERE name ='".$event."';");
     while ($row1 = mysql_fetch_row($num2)) {
   		$repo_id=$row1[0];
    }
	
	
	$check =mysql_query("Select groupID from repo_management WHERE repoID ='".$repo_id."';");
	
	 while ($row = mysql_fetch_row($check)) {
   		$group_id=$row[0];
    }
   		
   		
   		    echo "<h1>" . $event . "</h1>";
    $perm =mysql_query("Select * from repo_management WHERE repoID ='".$repo_id."';");
    while ($row = mysql_fetch_array($perm))
    {
    	
    	//echo $row['groupID'];
    	$group = mysql_query("Select name from groups where group_id ='".$row['groupID']."';");
    	while ($row3 = mysql_fetch_row($group)) {
   		$group_name=$row3[0];
   		echo $group_name;
    }
    	
        echo "<form action='add' method='POST'>
	<input type='hidden' name='step' value='3' />
	 <input type='hidden' name='submitted' id='submitted' value=" . $event . "/>
	 <input type= 'hidden' name ='groupName' id =groupName' value=". $group_name."/>";
	 
        if ($row['perm_read'] == 1)
        {
            echo "	<input type='checkbox' class='form' value='read' checked name='checkbox[]' /> Read";
            
        }
        else
        {
            echo "<input type='checkbox' class='form' value='read' name='checkbox[]' /> Read";
        }
        if ($row['perm_write'] == 1)
        {
            echo "	<input type='checkbox' class='form' value='write' checked name='checkbox[]' /> Write";
            
        }
        else
        {
            echo "	<input type='checkbox' class='form' value='write' name='checkbox[]' /> Write";
        }
        if ($row['perm_manage'] == 1)
        {
            echo "	<input type='checkbox' class='form' value='manage' checked name='checkbox[]' /> Manage";
            
        }
        else
        {
            echo "	<input type='checkbox' class='form' value='manage' name='checkbox[]' /> Manage";
        }
       
        echo "<input type='submit' name='Submit' value='Submit' /> </form>";
        	echo "<input type='submit' name='Delete' value='Delete' /> </form> <br/>";
        
    }
   		
   
   		
   		

   		}





?>