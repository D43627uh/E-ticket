<!DOCTYPE html>
<html><!--Sydney A.-->
<head>
<script type="text/javascript" src="./includes/jquery.js"></script> 
<script type="text/javascript" src="./includes/jquery-ui.js"> </script>
<link rel="stylesheet href="./includes/jquery-ui.css"/>
</head>
<div id="Container">
<?php $pagetitle = 'Onpoint e-tickets: Register';

 include ('./includes/header.php');
 if (isset($_POST['addmovie'])) {//this will handle the form for registering the movie***
		require_once("./includes/mysqlconnect.php");//connect to the database
		// create a function that will escape any characters that might cause problems with the query
	
		function escape_data($data) {
		
		global $dbc;//this connection is required
		if(ini_get('magic_quotes_gpc')){
		
		$data = stripslashes($data);
		}
		return mysql_real_escape_string($data, $dbc);
		}//the function ends here.
		
	 
	 $message = NULL; //sets the message to null initially because the button isset is TRUE
			  
			// From here,  script validates the data.
if (isset($_POST['showtime'])){
$showtime = implode (",", $_POST["showtime"]);
}
else {
$message .= "please choose the showtime for the movies";
}




  		 
			 if (empty($_POST['moviename'])){
			 $movname= FALSE;
			 $message = '<p>Enter the movie name!</p>';
			 } else {
			 $movname = escape_data($_POST['moviename']);
			 } 
			 
			 //check for charges
			 if (empty($_POST['charges'])){
			 $charges= FALSE;
			 $message = '<p>Enter the charges please!</p>';
			 } else {
			 $charges = escape_data($_POST['charges']);
			 } 
			//check for the movie date			 
			  	 
			 if (empty($_POST['moviedate'])){
			 $movdate= FALSE;
			 $message = '<p>Enter the date of the movie!</p>';
			 } else {
			 $movdate = escape_data($_POST['moviedate']);
			 $movdate = date('Y-m-d', strtotime(str_replace(".","-", $movdate)));
			
			 } 
			 
			 //check for the venue name
			 if (isset($_POST['hallselect'])){
			 $vename = $_POST['hallselect'];
			 $message = "";
			 }
			 $varhallselect = $_POST['hallselect'];
			 if (empty($varhallselect)){
			 $vename= FALSE;
			 $message .='<p>Enter the name of the venue</p>';
			 } else {
			 //switch case for the options selected in the combo box in the form
			 switch ($varhallselect)
			 {
			 case "hallA": $vename = "Hall A"; break;
			 case "hallB": $vename = "Hall B"; break;
			 case "hallC": $vename = "Hall C"; break;
			 case "hallD": $vename = "Hall D"; break;
			 default: $message .="Error!";
						
			 } if (empty($_POST["hallselect"])){
			 $restriction= NULL;
			 $message .="Select the age restriction";
			 } else{
			 
			 $restriction = escape_data(($_POST["restriction"]));
			 }
			 			 
			 if (empty($_POST['description'])){
			 $description= FALSE;
			 $message .='<p>Describe the movie briefly!</p>';
			 
			 } else {
 
			 $description =  escape_data(($_POST['description']));
			
			}
				if ($movname&& $vename && $description)
				{
				//everything is alright
				
				//check whether the movie name already exists
				$query = "SELECT moviename FROM movies WHERE moviename= '$movname'";
				$result = mysql_query($query);//run this query.
				if (mysql_num_rows($result)==0){//register this movie
				$query = "INSERT INTO  movies(movieID, moviedate, moviename,charges, description, venuename, restriction, showtime) VALUES ('','$movdate','$movname','$charges','$description','$vename','$restriction', '$showtime')";
				$result = mysql_query($query);//run this query
				 //This segment will confirm if the query ran or not
				 
					if ($result){ //if it ran OK
					
					header("location: http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/viewmovies.php");
			        exit();//quit the script
					} else { //if it did not run OK
				
				$message .= ("<p> <b>We could not register this movie due to a system error. We apologize for any inconvenience</b></p>" . mysql_error());
				}
				}
				else {
				$message= '<p>A movie with that title has already been registered to the system</p>';
				}
				mysql_close();//this will close the database connection_aborted
				unset($dbc);
				}else {
				$message .="<p>Please try again </p>";
				}
		}
		//here ends the main adding movie conditional.
			
			//print a message if there is one:
			
			}
			
	?>
	    <div id="content">
		<?php if (isset($message)) {
			echo '<br><br></br><p><font color ="red" text alignment="left">', $message, '</font> </p> <br/>' ;
			
			}?>
		<form id="regmovie" action = "<?php echo $_SERVER ["PHP_SELF"];?>" method = "POST">
		
		<table cellspacing="15" cellpadding="2" width ="70%" id="addmovietable">
		<tr><td><label>Date</label></td><td><input id="date" name="moviedate"/></td></tr> 
		<script type="text/javascript">
		
		$('input#date').datepicker();
				
		</script>
		<tr><td>Time</td>     <td> <input type="checkbox" name="showtime[]" value="13:00:00" />1300hrs </td>
							  <td><input type="checkbox" name="showtime[]" value="16:00:00" />1600hrs</td>
							  <td><input type="checkbox" name="showtime[]" value="19:00:00" />1900hrs</td></tr>
		<tr><td><label>Name of the movie </label></td><td><input type="text" name= "moviename" value=""/></td></tr>
		<tr><td><label>Charges </label></td><td><input type="text" name= "charges" value=""/></td></tr>
        
		<tr><td>Select the hall</td><td><select name="hallselect"><option value="">--Choose--</option>
		                                                   <option value="hallA">Hall A </option>
														   <option value="hallB">Hall B</option>
														   <option value="hallC">Hall C</option>
														   <option value="hallD">Hall D </option></td></select></tr>	
	<tr><td>Age restriction</td><td><select name="restriction"><option value="">--Choose--</option>
		                                                   <option value="GE">General Exhibition(GE) </option>
														   <option value="PG">Parental Guidance(PG 16)</option>
														   <option value="OVER18">Adults Only</option></tr>															   
														   
		<tr><td><label>Write the synopsis here</label></td><td><textarea rows=2" cols="18" value="" name="description"></textarea></p></td></tr>
		<tr><td></td><td><input type="submit" name= "addmovie" value="Add this movie"></td></tr>
		
		</table>
	
		</form><!--The addmovie form ends here-->
		
		</div>
	
		 <?php	 
	 include('./includes/footer.php');
	 ?>
	 	</div>
		</html>
	
	 