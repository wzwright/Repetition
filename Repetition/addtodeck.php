<?php
include('login.php');
$deck=$_GET['d'];
$front=$_GET['f'];
$back=$_GET['b'];
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$query="UPDATE decks SET front=CONCAT(front,'".$front."|'), back=CONCAT(back,'".$back."|'), rating=CONCAT(rating, '2.5|'), `interval`=CONCAT(`interval`, '0|'), dates=CONCAT(dates, '".date("Y-m-d")."|') WHERE id=".$deck;
mysqli_query($con,$query);
echo mysqli_affected_rows($con)==1?"card added": "addition failed";
?>