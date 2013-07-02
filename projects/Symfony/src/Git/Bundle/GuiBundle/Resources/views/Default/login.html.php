<?php

 if (isset($_COOKIE["TestUser"])){
 	 header("Location: create");      
 		exit();	
 
 }
 




?>

<!DOCTYPE html>
<html>
  <head>
    <title>Git Gui</title>
    <!-- Bootstrap -->
    <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('bootstrap/js/jquery.js') }}"><\/script>')</script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>

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
								
							</li>
							
						</ul>
						
					</div>
				</div>
	
<div class="span12 pagination-centered">

 <form action="authorize" method="POST">
<fieldset >
<legend>Login</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
 
<label for='username' >UserName*:</label>
<input type='text' name='username' id='username'  maxlength="50" />
 
<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength="50" />

<br/>
 
<input type='submit' name='Submit' value='Submit' />
 
</fieldset>
</form>
   
</div>
		

</body>
</html>s