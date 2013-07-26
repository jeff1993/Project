<?php
 require_once('scripts/ldap.php');
   require_once('scripts/database.php');
   $view->extend('GitGuiBundle:Default:base.html.php');
   $view['slots']->start('title');
   session_start();
   $_SESSION['Success'] = false;
   if ($_SESSION['LoggedIn'] !== TRUE) {
       header("Location:login");
       exit();
   }
?>

<div class='row-fluid'>
<div class='span8 offset2'>
<form action="add" method="POST">
   <fieldset >
      <legend>Create New <a href="#" rel="tooltip" title="If the path is '/sam/' the user will have access to
      every path that icludes 'sam' and its variations">Path</a></legend>
      <input type='hidden' name='step' value='2' />
      <label for='username' >Path*:</label>
      <input type='text' name='path' id='path' required  maxlength="50" />
      <br/>
      <input type="radio" name="userType" value="user" checked>User
      <input type="radio" name="userType" value="manager">Manager
      </br>
      <br/> 
      <button type="Submit" name ="Submit" class="btn">Submit</button>
   </fieldset>
</form>

</div>
</div>

<select id = "opts" onchange = "showForm()">
<option value = "0">Select Option</option>
<option value = "1">Option 1</option>
<option value = "2">Option 2</option>
</select>


<div id = "f1" style="display:none">
<form name= "form1">
<select id = "opts" onchange = "showForm()">
<option value = "0">Select Option</option>
<option value = "1">Option 5</option>
<option value = "2">Option 6</option>
</select>
</form>
</div>

<div id = "f2" style="display:none">
<form name= "form2">
<select id = "opts" onchange = "showForm()">
<option value = "0">Select Option</option>
<option value = "1">Option 3</option>
<option value = "2">Option 4</option>
</select>
</form>
</div>

<script type = "text/javascript">
function showForm(){
var selopt = document.getElementById("opts").value;
if (selopt == 1) {
document.getElementById("f1").style.display="block";
document.getElementById("f2").style.display="none";
}
if (selopt == 2) {
document.getElementById("f2").style.display="block";
document.getElementById("f1").style.display="none";
}
}

</script>

<script>
  $("a").tooltip({
                  'selector': '',
                  'placement': 'right'
                });
                </script>

<?php $view['slots']->stop();
?>