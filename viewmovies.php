<html>
<div id="container">
<?php
//this script enables the admin to view all the records from the users table
$pagetitle = 'Available and upcoming movies';
include("./includes/header.php");
?>
<div id="content">
<?php

 require_once("./includes/mysqlconnect.php");//to connect to the database
 //the next block of statements is going to create the query

 $query = "SELECT movieID, moviename AS mname, DATE_FORMAT(moviedate, '%M %d, %Y') AS ds, venuename AS venue FROM movies ORDER BY moviedate ASC";
 $result = mysql_query($query);//Run the query to select
 if ($result) {//If it ran OK, display the records.
     
	echo '<table id="report" tablewidth="auto" align = "center" cellspacing ="2" cellpadding="2">
	
	
	<tr><br><br><br><td align = "left"><b>ID</b></td><td><b>Title</b></td><td><b>Showing On</b></td><td><b>Venue</b></td></tr>';
    
//Fetch and print all records 
while ($row = mysql_fetch_array($result, MYSQL_NUM)){

echo "<tr><td align=\"left\"> 
$row[0]</td><td \"\" align=\"left\"> 
$row[1]</td><td>$row[2]</td><td>$row[3]</td><td><form method=\"POST\" action = \"viewmovies.php\"><td><input type=\"submit\" name = \"buyticket\" value=\"Buy ticket\"/></td><td><input type=\"submit\" name =\"viewdetails\"value=\"Movie details\"/></td></td></form></tr>\n";

}
echo '</table>';
mysql_free_result($result);//Free up the resources

} else {//If it did not run OK.
echo'<p><br>The registered movies could not be displayed due to a system error. Apologies for any inconvenience.</p><p>'. mysql_error() . '</p>';

} 

mysql_close(); //Close the database connection
unset($dbc);//stop using the variable dbc since connection has been closed.
 if(isset($_POST['buyticket'])){
 	header("location: http://" . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']). "/buyticket.php");
 
 }
 
?>
</div>
</div>
</html>