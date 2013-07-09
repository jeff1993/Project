<?php 
	require_once('scripts/ldap.php');
	require_once('scripts/database.php');
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Git Gui</title>
      <!-- Bootstrap -->
      <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
   </head>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <script src="js/bootstrap.js"></script>
<script src="<?php echo $view['assets']->getUrl('js/jQuery.dualListBox-1.3.js') ?>" type="text/javascript" ></script>
<script language="javascript" type="text/javascript">

        $(function() {

            $.configureBoxes();

        });

    </script>
    </head>
  <body>

    
				<div class="navbar">
					<div class="navbar-inner">
						
						<ul class="nav">
							<li><a href="login">Home</a></li>
							<li><a href="#">About</a></li>
							
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Users <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
								<li><a href="user">Show All Users</a></li>
									<li><a href="create">Create Users</a></li>
									<li><a href="#">link</a></li>
									<li><a href="#">link</a></li>
								</ul>
								
							</li>
							
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Groups <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
                     <li><a href="group">Manage Groups</a></li>
                  </ul>
						  <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Repos <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a href="repo">Manage Repositories</a></li>
                     <li><a href="../../../../../../../gitlist/index.php">View Repositories</a></li>
                  </ul>
               </li>		
							</li>
							
						</ul>
						
					</div>
				</div>
	<?php
$view['slots']->output('title', 'Hello Application') ?>
</body>
</html>


