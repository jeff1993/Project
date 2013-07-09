

<?php


mysql_connect("localhost", "root", "tucker24") or die("<p>Error connecting to database: " . mysql_error() . "</p>");

mysql_select_db("Test") or die("<p>Error selecting the database your-database-name: " . mysql_error() . "</p>");


?>