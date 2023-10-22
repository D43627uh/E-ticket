<!DOCTYPE>
<html>
<div id="container">

<?php 
$pagetitle = "Reset your password";
include('./includes/header.php');
require_once('./includes/mysqlconnect.php');


?>
<div id="content"><form method="POST" action="<?php echo($_SERVER['PHP_SELF']);?>">
<table class="resetpwd">
<tr><td>User Name</td><td><input type="text" value="" name="username"></td></tr>
<tr><td>Old Password</td><td><input type="password" value="" name="oldpassword"></td></tr>
<tr><td>New Password</td><td><input type="password" value="" name="newpassword"></td></tr>
<tr><td>Confirm new Password</td><td><input type="password" value="" name="newpassword1"></td></tr>
<tr><td></td><td><input type="submit" name = "submit" value= "Change Password"></td><tr>
</table>
</div>

<?php include('./includes/footer.php');?>
</div>
</html>