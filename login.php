<!DOCTYPE html>
<html>
<div id="container">
<?php
$pagetitle="Onpoint tickets - Customer login";
include("./includes/header.php");
	if (isset($_POST['login']))
	{
	require_once("./includes/mysqlconnect.php");//connect to the database
		//create a function that will escape problematic characters
				function escape_data($data) {
		
				global $db;//this connection is required
				if(ini_get('magic_quotes_gpc')){
				
				$data = stripslashes($data);
				}
				return mysql_real_escape_string($data, $db);
				}//the function ends here.
		$message = NULL;		
		//Validate all the fields to ensure that there is no empty fields\
		if(empty($_POST['username'])){//check the username
		$uname = FALSE;
		$message .= "Please enter your username</br>";
		
		} else{
		$uname = escape_data($_POST['username']);
		} if (empty($_POST['password'])) {//validate the password
		$pword = FALSE;
		$message .= "Please enter your password</br>";
		} else {//POSTed password
		
		$pword = escape_data($_POST['password']);
		}
		
		if ($uname && $pword){//If the credentials are ok
		$query = "SELECT username, firstname FROM users WHERE username = '$uname' AND password=md5('$pword')";
		$result = mysql_query($query) or die (mysql_Error());
		$row = mysql_fetch_array($result, MYSQL_NUM);
				if (!$row){
				$message .= '<br><br><p>Incorrect username, password or both. Check and try again</p>';	
			
				} else {
					//start session, register values and redirect
				session_name('YourloginID');
				session_start();
				$_SESSION ['firstname']= $row[1];
				$_SESSION ['username'] = $row[0];
				header("location: http://" . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']). "/custloggedin.php");
							
				}
				mysql_close();
		} else{
		$message .= "<p>Please try again.</p>";
		}
	}
  
?>
<div id="content">
<div id="forms">
<?php   if (isset($message)){echo '<p><font color ="red" text alignment="left">', $message, '</font> </p>';}?>
<form action = "<?php echo $_SERVER ["PHP_SELF"];?>" method = "POST">
<fieldset> <legend> Customer login</legend>
<p>Input your details in the form below</p>
<table cellpadding="2" cellspacing="4">
<tr><td><label><b>User Name: </b></label></td><td><input type="text" name= "username" value="<?php if (isset($_POST['username'])) echo stripslashes($_POST['username']); ?>"/></td></tr>
<tr><td></label><b>Password: </b></label></td><td><input type="password" name= "password" value=""/></td></tr>
<tr><td></td><td><input type= "submit"  value="Login" name= "login"></td></tr>
</table>
</fieldset>
</form>
</div>
</div>
<?php include("./includes/footer.php");?>
</div>
</html>