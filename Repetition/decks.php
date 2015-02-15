<html>
<head>
	<title></title>
</head>
<body>
<?php
include_once("header.php");
?>
<div class="container">
<div class="starter-template">
		<div id="decks">
			<?php
				echo '<a style="float:left;" href="/Repetition/newdeck.php"><button class="btn btn-default">Create a new deck</button></a><br><br>';
				$con=mysqli_connect("localhost","root","","test");
				if (mysqli_connect_errno()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				$query= "SELECT id, name, LEFT(description,100), dates FROM decks WHERE owner='".$_SESSION['user']."'";
				$result=mysqli_query($con,$query);
				echo "<table style='width:600px' class='table table-striped table-bordered'><tr><td>name</td><td>description</td><td>next repetition</td></tr>";
				while($row=mysqli_fetch_array($result))
				{
					$day='';
					$dates=explode('|',$row['dates']);
					$min= PHP_INT_MAX;
					for($i=0;$i<count($dates)-1;$i++)
					{
						if(strtotime($dates[$i])<$min)
							$min=strtotime($dates[$i]);
					}
					if($min<strtotime('now'))
						$day='now';
					else
					{
						$day=ceil(($min - strtotime('now')) / 86400);
						if($day==1)
							$day='1 day';
						else
							$day=$day.' days';
					}
					if(count($dates)==1) $day='no cards';
					echo '<tr><td><a href="./deck.php/?d='.$row['id'].'&n='.$row['name'].'">'.$row['name'].'</a></td><td>'.$row['LEFT(description,100)'].'</td><td>'.$day.'</td></tr>';
				}
				echo "</table>";
			?>
		</div>
	</div>
</div>
</body>
</html>