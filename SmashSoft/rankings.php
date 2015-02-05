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
<script>
var xmlhttp=new XMLHttpRequest();
$(document).ready(function(){
	var data=[<?php
	$con=mysqli_connect();
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit;
	}
	$query = "SELECT name FROM players";
	$result=mysqli_query($con,$query);
	echo '"'.mysqli_fetch_array($result)[0].'"';
	while($row=mysqli_fetch_array($result))
		echo ',"'.$row[0].'"';
	?>];
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			$("#ranks").html(xmlhttp.responseText);
		}
	}
	$("#search").autocomplete({source: data});
	$("#search").keypress(function(e) {
		if(e.keyCode == 13)
		{
			e.preventDefault();
			xmlhttp.open("GET","./ranksearch.php?p="+$("#search").val(),true);
			xmlhttp.send();
			$("#search").autocomplete('close');
		}
	});
});
</script>
<div class="container">
	<div class="starter-template">
		<div style="float:left;"><input id="search" type="text" class="form-control" style="margin-bottom:30px;" placeholder="Search"></input>
			<div id="ranks">
				<?php
					include_once "./ranksearch.php";
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>

