<?php
 $view->extend('GitGuiBundle:Default:base.html.php');
    $view['slots']->start('title');
    

echo "<h3> Successfully Altered Database</h3>
<a href='create'>Go Back</a>";

print $_SESSION['name'];

$view['slots']->stop();

?>