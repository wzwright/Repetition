<?php
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
$deck=$_GET['d'];
if(isset($_GET['r']))
{
	$rating=floatval($_GET['r']);
	$id=intval($_GET['i']);

	$query="SELECT rating, `interval`, dates FROM decks WHERE id=".$deck;
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_array($result);
	$ratings=explode('|', $row['rating']);
	$intervals=explode('|', $row['interval']);
	$dates=explode('|', $row['dates']);
	$rating=floatval($ratings[$id])+(0.1-(5-$rating)*(0.08+(5-$rating)*0.02));
	if($rating<1.3)
		$rating=1.3;
	if(intval($intervals[$id])==0&&floatval($ratings[$id])==2.5)
		$interval=1;
	else if(intval($intervals[$id])==1)
		$interval=6;
	else
		$interval=intval(intval($intervals[$id])*$rating+0.5);
	$newdate=date('Y-m-d', strtotime('+'.$interval.' days'));

	$ratings[$id]=$rating;	
	$intervals[$id]=$interval;
	$dates[$id]=$newdate;
	$ratingstring=implode('|',$ratings);
	$intervalstring=implode('|',$intervals);
	$datestring=implode('|',$dates);
	$query="UPDATE decks SET rating='".$ratingstring."', `interval`='".$intervalstring."', dates='".$datestring."' WHERE id=".$deck;
	mysqli_query($con,$query);
}

$query="SELECT front, back, dates FROM decks WHERE id=".$deck;
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$frontsides=explode('|', $row['front']);
$backsides=explode('|', $row['back']);
$dates=explode('|', $row['dates']);
for($i=0;$i<count($dates)-1;$i++)
{
	if(strtotime($dates[$i])<=strtotime("now"))
	{
		echo $frontsides[$i].'~'.$backsides[$i].'~'.$i;
		exit;
	}
}
echo "no more cards to study";
?>