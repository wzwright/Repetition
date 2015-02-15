<html>
<head>
	<title></title>
</head>
<body>
<?php
include_once("header.php");
?>
<script>
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		$("#lbl").html(xmlhttp.responseText);
		$("#lbl").show(300);
	}
}

function deleteCard(front){
	$("#lbl").hide(300);
	xmlhttp.open("GET","/Repetition/deleteCard.php?d="+<?php echo '"'.$_GET['d'].'"'?>+"&f="+front,true);
	xmlhttp.send();
}
</script>
<div class="container">
	<div class="starter-template">
		<div id="decks">
			<label id="lbl" style="text-align:left; width:100%; visibility:hidden;"></label>
			<?php
				$deck=$_GET['d'];
				echo '<a style="float:left;" href="/Repetition/Study.php/?d='.$_GET['d'].'&n='.$_GET['n'].'"><button class="btn btn-default">Study this deck</button></a><br><br><br>';
				echo '<a style="float:left;" href="/Repetition/deckadd.php/?d='.$_GET['d'].'&n='.$_GET['n'].'"><button class="btn btn-default">Add to this deck</button></a><br><br>';
				$con=mysqli_connect("localhost","root","","test");
				if (mysqli_connect_errno()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				$query= "SELECT COUNT(*) AS ct FROM decks WHERE id ='".$deck."'";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_array($result);
				if($row['ct']!=0)
				{
					if(isset($_SESSION['user']))
					$query= "SELECT name, LEFT(description,100), owner, front, back FROM decks WHERE id ='".$deck."'";
					$result=mysqli_query($con,$query);
					$row=mysqli_fetch_array($result);
					echo '<table class="table table-striped table-bordered"><tr><td>'.$row['name'].'</td><td>by '.$row['owner'].'</td></tr>';
					echo '<tr><td>Description</td><td>'.$row['LEFT(description,100)'].'</td></tr>';
					echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
					echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
					$frontSides=explode('|',$row['front']);
					$backSides=explode('|',$row['back']);
					for($i=0;$i<count($frontSides)-1;$i++)
					{
						echo '<tr><td>'.$frontSides[$i].'</td><td>'.$backSides[$i].'</td><td><a href="#" onClick="deleteCard(\''.$frontSides[$i].'\');">delete</a></td></tr>';
					}
				}
				else
				{
					echo 'no deck found with that id';
				}
			?>
		</div>			
	</div>
</div>
</body>
</html>