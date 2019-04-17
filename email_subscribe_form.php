<?php
include("email_list.php");
if(!$_POST){
// did not submit form yet - display form below

$display_block = "
<form method=\"POST\" action=\"".$_SERVER["PHP_SELF"]."\">
<p><strong>Your E-Mail Address:</strong><br>

<input type=\"email\" name=\"email\" size=\"40\">
<br>
<br>					
<input type=\"radio\" name=\"action\" value=\"sub\" checked> subscribe
<br>
<input type=\"radio\" name=\"action\" value=\"unsub\" > unsubscribe

<p><input type=\"submit\" name=\"submit\" id =\"submit\" value=\"submit\"></p>
</form>";

} else if (($_POST) && ($_POST["action"] == "sub")){
// submitted form trying to subscribe

	if($_POST["email"]==""){
 		header("Location: email_subscribe_form.php");
		exit;
		} else{
		//connect to db
		dB_connect();
		
		emailChecker($_POST["email"]);
		
		if(mysqli_num_rows($check_res) <1){
		//no email found in the dB - free result and add email to dB
		mysqli_free_result($check_res);
		
		$add_sql = "INSERT INTO email (email_address) VALUES('" . $_POST["email"]."');";
		$add_res = mysqli_query($mysqli, $add_sql) or die (mysqli_error($mysqli));
		$display_block = "<p>Thanks for signing up!</p>";
		
		//close connection
		mysqli_close($mysqli);
		}else{
		//email already exists in database
		$display_block = "<p>You already subscribed!</p>";
			}
		}
			
}else if (($_POST) && ($_POST["action"] == "unsub")) {
	// submit form trying to unsubscribe
	if($_POST["email"]==""){
		header("Location: email_subscribe_form.php");
		exit;
		} else{
		//connect to db
		dB_connect();
		
		emailChecker($_POST["email"]);
		
		if(mysqli_num_rows($check_res) <1){
		//no email found in the dB - free result and add email to dB
		mysqli_free_result($check_res);
		
		
		
		$display_block = "<p>Couldn't find your email address.</p>";
		
		//close connection
		mysqli_close($mysqli);
		}else{
		//email already exists in database

		while($row = mysqli_fetch_array($check_res)) {
		$id = $row["email_id"];
		}
		
		//remove email from db
		
		$del_sql = "DELETE FROM email
					WHERE email_id = '" . $id . "';";
		$del_res = mysqli_query($mysqli, $del_sql) or die (mysqli_error($mysqli));
		$display_block = "<p> you're unsubscribed!</p>";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="style.css" rel="stylesheet" type="text/css"/>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<title>subscribe/unsubscribe</title>
</head>
<body>
<div class="div_title_block" ><h1>Joke of the Day</h1></div>
<div class = "div_block">
<h2>Subscribe/Unsubscribe</h2>
<?php echo "$display_block";?>
</div>
</body>
</html>