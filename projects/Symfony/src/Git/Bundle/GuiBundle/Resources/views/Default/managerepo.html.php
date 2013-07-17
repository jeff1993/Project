<?php
   require_once('scripts/database.php');
   if ($_POST['step'] == 1) {
       $reponame  = $_REQUEST['reponame'];
       $path      = "/Users/jsimpson1271/Desktop";
       $repoType  = $_POST['repoType'];
       $reposlash = str_replace('/', ' ', $repoType);
       $repoType  = trim($reposlash);
       if ($repoType == 'git') {
           $git = 1;
           $svn = 0;
       } else {
           $git = 0;
           $svn = 1;
       }
       chdir($path);
       exec("mkdir " . $reponame);
       exec("cd " . $reponame, $output, $return);
       $path = "/Users/jsimpson1271/Desktop/" . $reponame;
       chdir($path);
       exec("git init", $output, $return);
       exec("touch README", $output5, $return);
       exec("git add README", $output1, $return);
       exec("git commit -m 'first commit'", $output2, $return);
       exec("git remote add origin git@github.com:jeff1993/" . $reponame . ".git", $output3, $return5);
       exec("git push -u origin master", $output4, $return);
       $tester       = mysql_query("Select name from repo WHERE name ='" . $reponame . "';");
       $num_results1 = mysql_num_rows($tester);
       if ($num_results1 == 0) {
           $insert_sql = "INSERT INTO repo (name, git, svn) " . "VALUES ('{$reponame}', '{$git}', '{$svn}');";
           //$insert_sql = "INSERT INTO repo_management (groupID, repoID) " . "VALUES ('{$group_id}', '{$repo_id}');";
           mysql_query($insert_sql) or die(mysql_error());
           header("Location: repo");
           exit();
       } else {
           header("Location: repo");
           exit();
       }
   }
   ?>