<?php
$con=mysqli_connect();
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
if(!isset($_GET['p']))
{
	echo "Failed";
	exit;
}
//$query="SELECT name FROM players WHERE password='".$_GET['p']."'";
$query="SELECT COUNT(*) AS ct FROM players WHERE password='".$_GET['p']."'";
$result=mysqli_query($con,$query);
if(mysqli_fetch_array($result)['ct']==0)
{
	echo "Failed";
	exit;
}
$query="SELECT name FROM players WHERE password='".$_GET['p']."'";
$result=mysqli_query($con,$query);
$name=mysqli_fetch_array($result)['name'];
$query="UPDATE events SET players=CONCAT(players, ' ".$name."') WHERE name='".$_GET['e']."'";
$result=mysqli_query($con,$query);
echo "Registered";
?>
