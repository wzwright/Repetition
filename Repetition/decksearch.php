<?php
$search=$_GET['s'];
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query= "SELECT COUNT(*) AS ct FROM decks WHERE name LIKE '%".$search."%' OR owner LIKE '%".$search."%'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$query= "SELECT id, name, LEFT(description,100), owner FROM decks WHERE name LIKE '%".$search."%' OR owner LIKE '%".$search."%'";
$result=mysqli_query($con,$query);
echo "<table class='table table-striped table-bordered'><tr><td>name</td><td>description</td><td>owner</td></tr>";
while($row=mysqli_fetch_array($result))
{
	echo '<tr><td><a href="./browse.php/?d='.$row['id'].'"">'.$row['name'].'</a></td><td>'.$row['LEFT(description,100)'].'</td><td>'.$row['owner'].'</td></tr>';
}
echo "</table>";
?>