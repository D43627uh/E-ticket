<html>
<head>
<title>Your Ticket </title>
</head>
<?php 
require_once("./includes/mysqlconnect.php");

 $query = "SELECT transactionID, amount, phone FROM payments ORDER BY transactionID ASC";
 $result = mysql_query($query);//Run the query to select
 if ($result) {//If it ran OK, display the records.
     
	echo '<table id="receipt" tablewidth="auto" align = "center" cellspacing ="2" cellpadding="2">
	
	
	<tr><br><br><br><td align = "left"><b>Transaction ID</b></td><td><b>Amount</b></td><td><b>Phone Number</b></td></tr>';
    
$row = (mysql_fetch_array($result, MYSQL_NUM));

echo "<tr><td align=\"left\"> 
$row[0]</td><td \"\" align=\"left\"> 
$row[1]</td><td>$row[2]</td></tr>\n";

}
?>
