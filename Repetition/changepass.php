<?php
$newpass=$_GET['np'];
$pass=$_GET['p'];
$user=$_GET['u'];
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$query="UPDATE users SET pass='".$newpass."' WHERE name='".$user."' AND pass='".$pass."'";
mysqli_query($con,$query);
echo mysqli_affected_rows($con)==1?"password changed": "incorrect password or player does not exist";
?>