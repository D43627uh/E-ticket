<!DOCTYPE>
<html>
<div id="container">

<?php
//this script enables the admin to view all the records from the users table
$pagetitle = 'View the current users';
include("./includes/header.php");

?>
<div id="content">
<?php require_once("./includes/mysqlconnect.php");//to connect to the database
 //the next block of statements are going to create the query
 
 $query = "SELECT CONCAT (lastname, ', ', firstname) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, phone AS phone, username FROM users ORDER BY registration_date ASC";
 $result = mysql_query($query);//Run the query to select

 if ($result) {//If it ran OK, display the records.
 
	echo '<table id="report" align = "center" cellspacing ="2" cellpadding="2">
	<tr><br><br><br><td align = "left"><b>Name</b></td><td><b>Date Registered</b></td><td><b>Phone Number</b></td></tr>';

//Fetch and print all records 
while ($row = mysql_fetch_array($result, MYSQL_NUM)){
echo "<tr><td align=\"left\"> 
$row[0]</td><td align=\"left\"> 
$row[1]</td><td align=\"left\">$row[2]</td><td><input type=\"hidden\" name=\"hidden\" value=\"username\"></td><td><input type=\"submit\" name=\"deleteuser\" value = \"Delete User\"/></td><td><input type=\"submit\" name=\"userdetails\" value = \"View Details\"/></td> </tr>\n";
}
echo '</table>';
mysql_free_result($result);//Free up the resources

} else {//If it did not run OK.
echo'<p><br><br><br>The users could not be displayed due to a system error. </p><p>'. mysql_error() . '</p>';

}
if (isset($_post['deleteuser'])) {
$deleteQuery = "DELETE FROM users where username = 'username'";
$deleteresult = mysql_query($deleteQuery, $dbc) or die (mysql_error()); 

}
 
mysql_close(); //Close the database connection
unset($dbc);//stop using the $dbc since connection has been closed.
include("./includes/footer.php");
?>
</div>
</div>