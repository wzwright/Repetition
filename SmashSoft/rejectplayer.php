<?php
$name=$_GET['n'];
$con=mysqli_connect();
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$query="DELETE FROM playersapps WHERE name='".$name."'";
echo mysqli_query($con,$query)==1?"player rejected": "player not rejected";
?>