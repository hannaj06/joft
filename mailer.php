<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<title>Joke of the Day Mailer</title>
</head>
<body>
<div class="div_title_block"><h1>Joke of the Day</h1></div>
<div class="div_block">
<h2>Mailer</h2>

<?php
include("email_list.php");
if(!$_POST){
//haven't seen the form so display it
echo "
<form method='post' action='".$_SERVER["PHP_SELF"]."'>
<p><strong>Subject:</strong><br>
<input type='text' name='subject' value='Joke of the Day " .date('m/d/y'). "' size='30'></p>
<p><strong>Mail Body:</strong><br>
<textarea name='message' rows='10' cols='50'></textarea>
<p><input type='submit' name='submit' value='submit' id='submit'></p>
</form>";
}else if ($_POST){
//check required fields before sending form
	if(($_POST["subject"]=="") || ($_POST["message"]=="")){
	header("Location: mailer.php");
	exit;
	}

	//connect to database
	dB_connect();
	if(mysqli_connect_errno()){
	//if connection fails, stop script
	printf("Connection failed: %s\n", mysqli_connect_error());
	exit;
	
	}else{
	//otherwise, get emails from subscribers list
	$sql = "SELECT email_address FROM email";
	$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	//create from mailheader
	
	$mailheader = "From: Joke of the Day Mailing List<jokes@taggedwebdesign.com>";

	
	while($row = mysqli_fetch_array($result)){
	set_time_limit(0);
	$email = $row["email_address"];
	mail("$email", stripslashes($_POST["subject"]), stripslashes($_POST["message"]), $mailheader);

	echo "newsletter sent to: ".$email."<br>";
	}
	
	$add_sql = "INSERT INTO jokes(time, jokes) VALUES('".date('m/d/y')."', '" . $_POST['message']."');";
	
	$res_add = mysqli_query($mysqli, $add_sql) or die(mysqli_error($mysqli));
	
	mysqli_free_result($result);
	mysqli_close($mysqli);
	}
	}
?>
<br><strong>Useful Links:</strong>
<ul>
	<li><a href="email_subscribe_form.php" target="_blank">Email Subscription Form</a></li>
	<li><a href="subscription_list.php" target="_blank">Subscription List</a></li>
	<li><a href="archive_jokes.php" target="_blank">Archive Jokes</a></li>
</ul>
</div>
</body>
</html>