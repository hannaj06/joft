<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<title>Archive Jokes</title>
</head>
<body>
<div class="div_title_block"><h1>Joke of the Day</h1></div>
<div class="div_block_extended">
<h2>Archive Jokes</h2>

<?php
include("email_list.php");

//connect to database
dB_connect();
if(mysqli_connect_errno()){
//if connection fails, stop script
printf("Connection failed: %s\n", mysqli_connect_error());
exit;
}

$sql = "SELECT joke_id, time, jokes FROM jokes ORDER BY joke_id";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

echo "<table cellpadding='4'>";

while($row = mysqli_fetch_array($result)){
echo "<tr><td class='tdd'>" . $row["time"] . "</td><td>" . $row["jokes"] . "</td></tr>";
}

?>
</table>
</div>
</body>
</html>