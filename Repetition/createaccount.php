<?php
$pass=$_GET['p'];
$user=$_GET['u'];
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$query="INSERT INTO users (name, pass) VALUES ('".$user."','".$pass."')";
mysqli_query($con,$query);
echo mysqli_affected_rows($con)==1?"user created": "someone already has this name";
?>