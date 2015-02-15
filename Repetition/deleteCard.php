<?php
include('login.php');
$deck=$_GET['d'];
$front=$_GET['f'];
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}

$query="SELECT front, back, rating, `interval`, dates FROM decks WHERE id=".$deck;
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);

$fronts=explode('|', $row['front']);
$backs=explode('|', $row['back']);
$ratings=explode('|', $row['rating']);
$intervals=explode('|', $row['interval']);
$dates=explode('|', $row['dates']);

for($i=0;$i<count($fronts)-1;$i++)
{
	if($fronts[$i]==$front)
	{
		unset($fronts[$i]);
		unset($backs[$i]);
		unset($ratings[$i]);
		unset($intervals[$i]);
		unset($dates[$i]);
	}
}

$frontstring=implode('|',$fronts);
$backstring=implode('|',$backs);
$ratingstring=implode('|',$ratings);
$intervalstring=implode('|',$intervals);
$datestring=implode('|',$dates);

$query="UPDATE decks SET front='".$frontstring."', back='".$backstring."', rating='".$ratingstring."', `interval`='".$intervalstring."', dates='".$datestring."' WHERE id=".$deck." LIMIT 1;"
mysqli_query($con,$query);
echo mysqli_affected_rows($con)==1?"card removed": "card removal failed";
?>