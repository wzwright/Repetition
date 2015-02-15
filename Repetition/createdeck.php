<?php
include('login.php');
$name=$_GET['n'];
$description=$_GET['d'];
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$query="INSERT INTO decks (name, description, owner) VALUES ('".$name."','".$description."','".$_SESSION['user']."')";
mysqli_query($con,$query);
echo mysqli_affected_rows($con)==1?"deck created": "deck creation failed";
?>