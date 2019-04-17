<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<title>Subscription List</title>
</head>
<body>
<div class="div_title_block"><h1>Joke of the Day</h1></div>
<div class="div_block">


<?php
include("email_list.php");

//connect to database
dB_connect();
if(mysqli_connect_errno()){
//if connection fails, stop script
printf("Connection failed: %s\n", mysqli_connect_error());
exit;
}

$sql = "SELECT email_id, email_address FROM email ORDER by email_id";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));


echo "<h2>" . mysqli_num_rows($result) . " Current Subscribers</h2>";

echo "<ul>";
while($row = mysqli_fetch_array($result)){
echo "<li>" . $row["email_address"] . "</li>";
}

?>
</ul>
</div>
</body>
</html>