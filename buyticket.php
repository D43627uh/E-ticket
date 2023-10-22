<!DOCTYPE>
<html>
<div id="container">
<?php 
$pagetitle = "Buy a ticket";
include('./includes/header.php');
require_once('./includes/mysqlconnect.php');
$message = "";
if(isset($_POST['buyticket'])){
	if (empty($_POST['transac_id'])){
	$transac_id = FALSE;
	$message .= "You MUST input the transaction ID for processing to begin";
	}else{
	$transac_id = $_POST['transac_id'];
	}  
	if (empty($_POST['movieID'])){
	$movieID = FALSE;
	$message .= "You MUST input the transaction ID for processing to begin";
	}else{
	$movieID = $_POST['movieID'];
	}  
	if (empty($_POST['username'])){
	$username = FALSE;
	$message .= "Please key in your username for record keeping";
	}else{
	$username = $_POST['username'];
	}  
    if (empty($_POST['phonenumber'])){
	$phonenumber = FALSE;
	$message .= "Your phone number please";
	}else{
	$phonenumber = $_POST['phonenumber'];
	}  
	
	
			 if (empty($_POST['numtickets'])){
			 $numtickets= FALSE;
			 $message .='<p>Choose the number of tickets</p>';
			 } else {
			 //switch case for the options selected in the combo box in the form
			 switch ($_POST['numtickets'])
			 {
			 case "1": $numtickets = "1"; break;
			 case "2": $numtickets = ""; break;
			 case "3": $numtickets = "3"; break;
			 default: $message .="No quantity chosen!";
             }
	}
	
	$query = "SELECT username FROM users WHERE username = '$username' ";
		$result = mysql_query($query) or die (mysql_Error());
		$row = mysql_fetch_array($result, MYSQL_NUM);
				if (!$row){
				$message .= '<p>Error! The username you entered does not exist. Check and try again</p>';	
			
				} else {
$query = "SELECT transac_id FROM ticket_purchase WHERE transac_id = '$transac_id' ";
		$result = mysql_query($query) or die (mysql_Error());
		$row = mysql_fetch_array($result, MYSQL_NUM);
				if ($row){
				$message .= '<p>ERROR! That transaction code has already been used!</p>';	
			} else {
			
$transactionquery = ("SELECT transactionID, phone FROM payments WHERE transactionID = '$transac_id' AND phone='$phonenumber'");
$check = mysql_query($transactionquery) or die (mysql_Error());

$row = mysql_fetch_array($check, MYSQL_NUM);
if(!$row){
$message .="ERROR! the transaction ID you entered does not exist, please check and try again after a few minutes"; 
} else{

$buyticketquery = "INSERT INTO  ticket_purchase (transac_id, username, phone, payment_date, qty) VALUES ('$transac_id','$username','$phonenumber',NOW(),'$numtickets')"; 
$result = mysql_query($buyticketquery) or die (mysql_error());
if ($result){
header ("location:/onpoint/downloadticket.php");
} else {
$message .="An error has occured while processing your request, we apologize for any inconvenience" . mysql_error();
}
}
}
}
}
?>
<div id="content">
<?php 
if (isset($message)){
echo '<p><font color ="red" text alignment="left">', $message, '</font> </p><br/>' ;

}?>
<br/><p>Pay using Lipa na M-PESA, enter the transaction code in the first field below and other details</p>
<form method = "POST" action="<?php echo($_SERVER['PHP_SELF']) ?>" >
<table>
<tr><td>Payment transaction ID</td><td><input type="text" name="transac_id" value=""/></td></tr>
<tr><td>Movie ID</td><td><input type="text" name="movieID" value=""/></td></tr>
<tr><td>User name</td><td><input type="text" name="username" value=""/></td></tr>
<tr><td>Phone Number</td><td><input type="text" name="phonenumber" value=""/></td></tr>
<tr><td>Number of tickets </td><td><select name="numtickets"><option value="">--Choose--</option>
		                                                   <option value="1">1</option>
														   <option value="2">2</option>
														   <option value="3">3</option></td></tr>
<tr><td></td><td><input type="submit" name="buyticket" value="Buy ticket"></td></tr>														
</table>
</form>

</div>
</div>
</html>