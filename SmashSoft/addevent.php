<?php
$name=$_GET['n'];
$date=$_GET['d'];
$setups=$_GET['s'];
$con=mysqli_connect();
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$query="INSERT INTO events (name, date, setups) VALUES ('".$name."','".$date."','".$setups."')";
echo mysqli_query($con,$query)==1?"Event added": "Event not added";
?>
