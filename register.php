<!DOCTYPE html>
<html>]
<div id="container">

<?php $pagetitle = 'Onpoint e-tickets: Register';

 include ('./includes/header.php');
 if (isset($_POST['submit'])) {//this will handle the form for registration***
		require_once("./includes/mysqlconnect.php");//connect to the database
		// create a function that will escape any characters that might cause problems with the query
		
		function escape_data($data) {
		
		global $db;//this connection is required
		if(ini_get('magic_quotes_gpc')){
		
		$data = stripslashes($data);
		}
		return mysql_real_escape_string($data, $db);
		}//function ends here.
		
	 
	 $message = NULL; //sets the message to null initially because the button isset [gets TRUE]
			  
			// From here, this script validates the data.
			
			 if (empty($_POST['firstname'])){
			 $fname= FALSE;
			 $message = '<p>You forgot to enter your first name!</p>';
			 } else {
			 $fname = escape_data($_POST['firstname']);
			 } 
			 //check for last name
			 
			 if (empty($_POST['lastname'])){
			 $lname= FALSE;
			 $message .='<p>You forgot to enter your last name!</p>';
			 } else {
			 $lname = escape_data($_POST['lastname']);
			 } 
			  //check for phone number
			 if (empty($_POST['phone'])){
			 $phone= FALSE;
			 $message .='<p>You forgot to enter your Phone number!</p>';
			 } else {
			 $phone = escape_data($_POST['phone']);
			 }
			 //check for the email address
			 
			 if (empty($_POST['email'])){
			 $email= FALSE;
			 $message .='<p>You forgot to enter your email address!</p>';
			 } else {
			 $email = escape_data($_POST['email']);
			 } 
			 
			 //check for the user name
			 
			 if (empty($_POST['username'])){
			 $uname= FALSE;
			 $message .='<p>You forgot to enter your user name!</p>';
			 } else {
			 $uname =  escape_data($_POST['username']);
			 } 
			 //validate the password and ensure it matches with its confirmation
			 
			 
			 if (empty($_POST['password1'])){
			 $pword= FALSE;
			 $message .='<p>You forgot to enter your password</p>';
			 
			//compare the two passwords and check if they match
			 
			 } else {
			 if (($_POST['password1']) == ($_POST['password2'])){
			 
			 $pword =  escape_data(($_POST['password1']));
			 } else {
			 
			 $pword =FALSE;
			 $message .= '<p color="#FF0000">Your password did not match the confirmed password</p>';
				 }
				}
				if ($fname && $lname && $phone && $email  && $uname && $pword){ //everything is alright
				
				//check whether the username already exists
				$query = "SELECT username FROM users WHERE username= '$uname'";
				$result = mysql_query($query);//run this query.
				if (mysql_num_rows($result)==0){//register the user into the database
				$query = "INSERT INTO  users(firstname, lastname, phone, username, email, password, secretword, registration_date) VALUES ('$fname', '$lname', '$phone','$uname', '$email', md5('$pword'), '$secretword', NOW())";
				$result = mysql_query($query);//run this query
				 //This segment will confirm if the query ran or not
				 
					if ($result){ //if it ran OK
					
					header("location: http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/thankyou.php");
			        exit();//quit the script
					} else { //if it did not run OK
				
				$message .= ("<p <br/><b>You could not be registered due to a system error. We apologize for any inconvenience</b></p>" . mysql_error());
				}
				}else {
				$message= '<p>Oops! that username has already been taken</p>';
				}
				mysql_close();//this will close the database connection_aborted
				unset($dbc);
				}else {
				$message .="<p>Please try again </p>";
				}
		} //here ends the main register conditional.
		?>
		<div id="content">
		
		<form action = "<?php echo $_SERVER ["PHP_SELF"];?>" method = "POST">
		<fieldset><legend> Enter your information in the form below:</legend>
		<?php 	//print message if there is one:
			if (isset($message)) {
			echo '<p>The following errors occured:</p><p><font color ="red" text alignment="left">', $message, '</font> </p> <br/>' ;
			}?>
		<table cellspacing="4" cellpadding="2">
		
		<tr><td>First Name</td><td><input type="text" name= "firstname" value="<?php if (isset($_POST['firstname'])) echo stripslashes($_POST['firstname']); ?>"/> </tr>
		
		
		
		<tr><td><label>Last Name </label></td><td><input type="text" name= "lastname" value="<?php if (isset($_POST['lastname'])) echo stripslashes($_POST['lastname']); ?>"/> </td></tr>
		
		
			
		
		<tr><td><label>Mobile phone </label></td><td><input type="text" name= "phone" value=""/> 
		<td></tr>
		
		
		
		<tr><td><label>Email Address</label></td><td><input type="text" name= "email" value="<?php if (isset($_POST['email'])) echo stripslashes($_POST['email']); ?>"/></td></tr>
		
		
		
		<tr><td><label>User Name </label></td><td><input type="text" name= "username" value="<?php if (isset($_POST['username'])) echo stripslashes($_POST['username']); ?>"/></td></tr>
		
		
		
		<tr><td><label>Password </label></td><td><input type="password" name= "password1" value=""/> </td></tr>
		
		
		
		<tr><td><label>Confirm Password</label></td><td><input type="password" name= "password2" value=""/></td></tr>
		
		<tr><td><label>Secret word (in-case you forget your password)</label></td><td><input type="text" name= "secretword" value=""/></td><td> 
				
		<tr><td></td><td><input type="submit" name= "submit" value="Register"/> </td></tr>
		
		</table>
		</fieldset>
		</form><!--The registration form ends here-->
		</div>
		<?php include('./includes/footer.php');?>
		</div>
		</html>
	
