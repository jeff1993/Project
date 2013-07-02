<?php

$first_name = trim($_REQUEST['first_name']);
$last_name = trim($_REQUEST['last_name']);
$email = trim($_REQUEST['email']);
$facebook_url = str_replace("facebook.org", "facebook.com",
                            trim($_REQUEST['facebook_url']));
$position = strpos($facebook_url, "facebook.com");
if ($position === false) {
  $facebook_url = "http://www.facebook.com/" . $facebook_url;
}
$twitter_handle = trim($_REQUEST['twitter_handle']);
$twitter_url = "http://www.twitter.com/";
$position = strpos($twitter_handle, "@");
if ($position === false) {
  $twitter_url = $twitter_url . $twitter_handle;
} else {
  $twitter_url = $twitter_url . substr($twitter_handle, $position + 1);
}

?>

<html>
 <head>
  <link href="../../css/phpMM.css" rel="stylesheet" type="text/css" />
 </head>

 <body>
  <div id="header"><h1>PHP & MySQL: The Missing Manual</h1></div> 
  <div id="example">Example 3-1</div>

  <div id="content">
    <p>Here's a record of what information you submitted:</p>
    <p>
      Name: <?php echo $first_name . " " . $last_name; ?><br />
      E-Mail Address: <?php echo $email; ?><br />
      <a href="<?php echo $facebook_url; ?>">Your Facebook page</a><br />
      <a href="<?php echo $twitter_url; ?>">Check out your Twitter feed</a><br />
    </p>
  </div>
  <html>
 <head>
  <link href="../css/phpMM.css" rel="stylesheet" type="text/css" />
 </head>

 <body>
  <div id="header"><h1>PHP & MySQL: The Missing Manual</h1></div>
  <div id="example">Example 3-1</div>

  <div id="content">
    <h1>Join the Missing Manual (Digital) Social Club</h1>
    <p>Please enter your online connections below:</p>
    <form action="scripts/getFormInfo.php" method="POST">
	    <fieldset>
        <label for="first_name">First Name:</label> 
        <input type="text" name="first_name" size="20" /><br />
        <label for="last_name">Last Name:</label> 
        <input type="text" name="last_name" size="20" /><br />
        <label for="email">E-Mail Address:</label> 
        <input type="text" name="email" size="50" /><br />
        <label for="facebook_url">Facebook URL:</label> 
        <input type="text" name="facebook_url" size="50" /><br />
        <label for="twitter_handle">Twitter Handle:</label> 
        <input type="text" name="twitter_handle" size="20" /><br />
      </fieldset>
      <br />
      <fieldset class="center">
        <input type="submit" value="Join the Club" />
        <input type="reset" value="Clear and Restart" />
      </fieldset>
    </form>
  </div>

  <div id="footer"></div>
 </body>
</html>

  <div id="footer"></div>
 </body>
</html>
