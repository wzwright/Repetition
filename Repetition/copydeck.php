<?php
$deck=$_GET['d'];
$owner=$_GET['u'];
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$query="SELECT name, description, front, back, owner FROM decks where id=".$deck;
$result=mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
if($row['owner']==$owner)
{
	echo "This is your deck";
	exit;
}
$repeat=count(explode('|',$row['front']))-1;
$rating=str_repeat('2.5|',$repeat);
$interval=str_repeat('0|',$repeat);
$dates=str_repeat(date("Y-m-d").'|',$repeat);
$query='INSERT INTO decks (name, description, front, back, rating, `interval`, owner, dates) VALUES ("'.$row['name'].'","'.$row['description'].'","'.$row['front'].'","'.$row['back'].'","'.$rating.'","'.$interval.'","'.$owner.'","'.$dates.'")';
echo mysqli_query($con,$query)==1?"Deck has been added to your collection": "didn't work";
?>