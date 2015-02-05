<?php
$con=mysqli_connect();
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
if(!isset($_GET['w'])||!isset($_GET['l']))
{
	echo "specify players";
	exit;
}
else if(!isset($_GET['pw'])){
	echo "enter password";
	exit;
}
$sum=0;
$w=$_GET['w'];
$query= "SELECT COUNT(*) AS ct FROM players WHERE name ='".$w."'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$sum+=$row['ct'];
$l=$_GET['l'];
$query= "SELECT COUNT(*) AS ct FROM players WHERE name ='".$l."'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$sum+=$row['ct'];
if($sum<2)
{
	echo "player(s) do(es) not exist";
	exit;
}

$query= "SELECT rating, password FROM players WHERE name ='".$l."'";
$result=mysqli_query($con,$query);
$pw=$_GET['pw'];
$row=mysqli_fetch_array($result);
if($row['password']!=$pw)
{
	echo "incorrect password";
	exit;
}
$lRate=$row['rating'];
$query= "SELECT rating FROM players WHERE name ='".$w."'";
$result=mysqli_query($con,$query);
$wRate=mysqli_fetch_array($result)['rating'];
$rateChange=round((1-1/(1+pow(10,($lRate-$wRate)/400)))*50);
$query="UPDATE players SET wins=wins+1, rating=".($wRate+$rateChange)." WHERE name ='".$w."'";
$result=mysqli_query($con,$query);
$query="UPDATE players SET losses=losses+1, rating=".($lRate-$rateChange)." WHERE name ='".$l."'";
$result=mysqli_query($con,$query);
echo $w." rating is ".($wRate+$rateChange).", ".$l." rating is ".($lRate-$rateChange);

$query="INSERT INTO matches (winner, loser, wChar, lChar, wStock, event) VALUES ('".$_GET['w']."','".$_GET['l']."','".$_GET['wc']."','".$_GET['lc']."','".$_GET['ws']."','".$_GET['e']."')";
$result=mysqli_query($con,$query);