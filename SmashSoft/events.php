<?php
	mb_internal_encoding('UTF-8');
?>
<html>
<head>
	<title>SmashSoft</title>
</head>
<body>
	<?php
	include_once "./header.php";
	?>
	<div class="container">
		<div class="starter-template">
			<div style="float:left;">
				<table class="table table-striped table-bordered">
					<?php
					$con=mysqli_connect("flax.arvixe.com","winston","bionicle","smash");
					if (mysqli_connect_errno()) {
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						exit;
					}
					$query="SELECT name, date from events ORDER BY date DESC";
					$result=mysqli_query($con,$query);
					while($row=mysqli_fetch_array($result))
						echo '<tr><td><a href="./event.php?e='.$row['name'].'">'.$row['name'].'</a></td><td>'.$row['date'].'</td></tr>';
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>