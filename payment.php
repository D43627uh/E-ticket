<html>
<div id="container">
<?php
$pagetitle = "Confirm/ Record payments";
include('./includes/header.php');
require_once('./includes/mysqlconnect.php');
$message = $record = "";
if(isset($_POST['confirm'])){
	if (empty($_POST['transac_id'])){
	$transac_id = FALSE;
	$message .= "Input the transaction ID";
	}else{
	$transac_id = $_POST['transac_id'];
	}  
	
	if (empty($_POST['amount'])){
	$amount = FALSE;
	$message .= "Input the amount received";
	}else{
	$amount = $_POST['amount'];
	} 

	if (empty($_POST['phonenumber'])){
	$phonenumber = FALSE;
	$message .= "Input the Phone number for record-keeping purposes";
	}else{
	$phonenumber = $_POST['phonenumber'];
	}  
	if ($transac_id && $amount && $phonenumber)
				{
				//everything is alright
				
				//check whether the transactionID name already exists
				$query = "SELECT transactionID FROM payments WHERE transactionID= '$transac_id'";
				$result = mysql_query($query);//run this query.
				if (mysql_num_rows($result)==0){//register this movie
				$query = "INSERT INTO  payments(transactionID, amount, phone) VALUES ('$transac_id','$amount', '$phonenumber')";
				$result = mysql_query($query);//run this query
				 //This segment will confirm if the query ran or not
				 
					if ($result){ //if it ran OK
					
					header("location: http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/adminpage.php");
			        exit();//quit the script
					} else { //if it did not run OK
				
				$message .= ("<p> <b>We could not add this record due to a system error </b></p>" . mysql_error());
				}
				}
				else {
				$message= '<p>A payment with that transactionID has already been registered to the system</p>';
				}
				mysql_close();//this will close the database connection_aborted
				unset($dbc);
				}else {
				$message .="<p>Please try again </p>";
				}
	
	
}

?>
<div id="content">
<?php if(isset($message)){
echo '<p><font color ="red" text alignment="left">', $message, '</font> </p><br/>' ;

}?>
<form method = "POST" action="<?php echo($_SERVER['PHP_SELF']) ?>" >
<table>
<tr><td>Transaction ID</td><td><input type="text" name="transac_id" value=""/></td></tr>
<tr><td>Amount received</td><td><input type="text" name="amount" value=""/></td></tr>
<tr><td>User Phone No.</td><td><input type="text" name="phonenumber" value=""/></td></tr>
<tr><td></td><td><input type="submit" name="confirm" value="Record payment"></td></tr>
</table>
</form>
</div>
</div>
</html>

