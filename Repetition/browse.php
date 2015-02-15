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
var xmlhttp2=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    $("#add").text(xmlhttp.responseText);
    $("#add").attr('onClick','');
  } 
}
xmlhttp2.onreadystatechange=function() {
  if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
    $("#decks").html(xmlhttp2.responseText);
  } 
}
function add(deck)
{
  xmlhttp.open("GET","/Repetition/copydeck.php?u="+<?php echo '"'.$_SESSION['user'].'"' ?>+'&d='+deck,true);
  xmlhttp.send();
}
$(document).ready(function(){
$("#search").keypress(function(e) {
		if(e.keyCode == 13)
		{
			e.preventDefault();
			xmlhttp2.open("GET","/Repetition/decksearch.php?s="+$("#search").val(),true);
			xmlhttp2.send();
		}
	});
});
</script>
<div class="container">
	<div class="starter-template">
		<div style="float:left;"><input id="search" type="text" class="form-control" style="margin-bottom:30px;" placeholder="Search"></input>
			<div id="decks">
				<?php
					$con=mysqli_connect("localhost","root","","test");
					if (mysqli_connect_errno()) {
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					if(!isset($_GET['d']))
					{
						$query= "SELECT id, name, LEFT(description,100), owner FROM decks";
						$result=mysqli_query($con,$query);
						echo "<table class='table table-striped table-bordered'><tr><td>name</td><td>description</td><td>owner</td></tr>";
						while($row=mysqli_fetch_array($result))
						{
							echo '<tr><td><a href="./browse.php/?d='.$row['id'].'"">'.$row['name'].'</a></td><td>'.$row['LEFT(description,100)'].'</td><td>'.$row['owner'].'</td></tr>';
						}
						echo "</table>";
					}
					else
					{
						$deck=$_GET['d'];
						$query= "SELECT COUNT(*) AS ct FROM decks WHERE id ='".$deck."'";
						$result=mysqli_query($con,$query);
						$row=mysqli_fetch_array($result);
						if($row['ct']!=0)
						{
							if(isset($_SESSION['user']))
								echo '<button id="add" onClick="add('.$_GET['d'].');" class="btn btn-default">Add this deck to your collection</button><br><br>';
							$query= "SELECT name, LEFT(description,100), owner, front, back FROM decks WHERE id ='".$deck."'";
							$result=mysqli_query($con,$query);
							$row=mysqli_fetch_array($result);
							echo '<table class="table table-striped table-bordered"><tr><td>'.$row['name'].'</td><td>by '.$row['owner'].'</td></tr>';
							echo '<tr><td>Description</td><td>'.$row['LEFT(description,100)'].'</td></tr>';
							echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
							$frontSides=explode('|',$row['front']);
							$backSides=explode('|',$row['back']);
							for($i=0;$i<count($frontSides)-1;$i++)
							{
								echo '<tr><td>'.$frontSides[$i].'</td><td>'.$backSides[$i].'</td></tr>';
							}
						}
						else
						{
							echo 'no deck found with that id';
						}
					}
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>