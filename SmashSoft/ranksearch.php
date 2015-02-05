<?php
$con=mysqli_connect();
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(!isset($_GET['p']))
{
	$query= "SELECT name, rating FROM players ORDER BY rating DESC";
	$result=mysqli_query($con,$query);
	echo "<table class='table table-striped table-bordered'><tr><td>Player</td><td>Rating</td></tr>";
	while($row=mysqli_fetch_array($result))
	{
		echo '<tr><td>'.$row['name'].'</td><td>'.$row['rating'].'</td></tr>';
	}
	echo "</table>";
}
else
{
	$p=$_GET['p'];
	$query= "SELECT COUNT(*) AS ct FROM players WHERE name ='".$p."'";
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_array($result);
	if($row['ct']!=0)
	{
		$query= "SELECT rating, wins, losses FROM players WHERE name ='".$p."'";
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_array($result);
		echo '<table class="table table-striped table-bordered"><tr><td>Player</td><td>'.$p.'</td></tr>';
		echo '<tr><td>Rating</td><td>'.$row['rating'].'</td></tr>';
		echo '<tr><td>Wins</td><td>'.$row['wins'],'</td></tr>';
		echo '<tr><td>Losses</td><td>'.$row['losses'],'</td></tr>';
		echo '<tr><td>Win Rate</td><td>'.(($row['wins']==$row['losses'] and $row['losses']=='0')?'0':intval($row['wins'])/(intval($row['losses'])+intval($row['wins']))),'</td></tr></table>';
	}
	else
	{
		echo 'no player found with that name';
	}
}
?>