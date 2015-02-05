<?php
$name=$_GET['n'];
$password=$_GET['p'];
$realname=$_GET['rn'];
$con=mysqli_connect();
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$query="SELECT COUNT(*) AS ct FROM players WHERE name='".$name."' or password='".$password."'";
$result=mysqli_query($con,$query);
if(mysqli_fetch_array($result)['ct']>0)
	echo "username or password already in use";
else{
	$query="INSERT INTO players".(isset($_GET['a'])?"apps":"")." (name, password, realname) VALUES ('".$name."','".$password."','".$realname."')";
	echo mysqli_query($con,$query)==1?"player added": "player not added";
}
?>