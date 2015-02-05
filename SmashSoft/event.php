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
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			$("#lbl").text(xmlhttp.responseText);
			$("#lbl").show(300);
		}
	}

	function register()
	{
		$("#lbl").hide(300);
		xmlhttp.open("GET","./eventregister.php?p="+$("#password").val()+"&e="+<?php echo "'".$_GET['e']."'";?>,true);
		xmlhttp.send();
	}

	function deregister()
	{
		$("#lbl").hide(300);
		xmlhttp.open("GET","./deregister.php?p="+$("#deregpassword").val()+"&e="+<?php echo "'".$_GET['e']."'";?>,true);
		xmlhttp.send();
	}

	function record()
	{
		$("#lbl").hide(300);
		xmlhttp.open("GET","./gameresult.php?pw="+$("#passwordLoser").val()+"&e="+<?php echo "'".$_GET['e']."'";?>+"&w="+$("#winner").val()+"&l="+$("#loser").val()+"&wc="+$("#wChar").val()+"&lc="+$("#lChar").val()+"&ws="+$("#wStock").val(),true);
		xmlhttp.send();
	}
	</script>
	<div class="container">
		<div class="starter-template">
			<?php					
			if(!isset($_GET['e']))
			{
				echo 'No event selected';
				exit;
			}
			$con=mysqli_connect();
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				exit;
			}
			$query="SELECT date, players, setups from events WHERE name= '".$_GET['e']."'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_array($result);
			$players=explode(",",$row['players']);
			$setups=$row['setups'];
			echo '<div style="margin-bottom:10px;"><h4 style="margin:0;">'.$_GET['e'].", ".$row['date'].'</h2><br>'.(count(array_count_values($players))-1).' players registered</div>';
			echo '<div class="col-md-6 col-md-push-3"><table style="width:100%;" class="table table-striped table-bordered">';
			$query="SELECT name, realname, rating FROM players WHERE name IN('".join("','",$players)."')";
			$result=mysqli_query($con,$query);
			$ratingarr=[];
			while($row=mysqli_fetch_array($result))
			{
				echo '<tr><td>'.$row['name'].'</td><td>'.$row['realname'].'</td><td>'.$row['rating'].'</td></tr>';
				$ratingarr[$row['name']]=intval($row['rating']);
			}
			echo '</table><table style="width:100%; margin-top:20px;" class="table table-striped table-bordered"><tr><th>winner</th><th>character</th><th>loser</th><th>character</th><th>winner stock</th></tr>';

			$query="SELECT winner, loser, wChar, lChar, wStock from matches WHERE event= '".$_GET['e']."'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			{
				echo '<tr><td>'.$row['winner'].'</td><td>'.$row['wChar'].'</td><td>'.$row['loser'].'</td><td>'.$row['lChar'].'</td><td>'.$row['wStock'].'</td></tr>';
			}
			echo '</table></div>';
			echo '<div class="col-md-3 col-md-pull-6">';
			arsort($ratingarr);
			$temp=intval(0.5+count($ratingarr)/$setups);
			$setupsize=$temp==0?1:$temp;
			for ($i = 1; $i <= $setups; $i++) {
				echo 'Setup '.$i.'<table style="width:100%; margin-bottom:20px;" class="table table-striped table-bordered">';
				foreach(array_slice($ratingarr,($i-1)*$setupsize,$setupsize) as $curplayer=>$value){
					echo '<tr><td>'.$curplayer.'</td></tr>';
				}
				echo '</table>';
			}
			echo '</div>';
			?>
				<div class="col-md-3">
					<label id="lbl" style="width:100%; display:none;"></label>
					<span>Register with Password</span>
					<input id="password" class="form-control" style="margin-bottom:10px;" type="password" placeholder="password"></input>
					<button id="register" class="btn btn-default" onClick="register();">Register</button>
					<br><br>
					<span>Deregister</span>
					<input id="deregpassword" class="form-control" style="margin-bottom:10px;" type="password" placeholder="password"></input>
					<button id="deregister" class="btn btn-default" onClick="deregister();">Deregister</button>
					<br><br>
					<span>Record Game</span>
					<input id="winner" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="winner"></input>
					<input id="wChar" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="winner character"></input>
					<input id="loser" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="loser"></input>
					<input id="lChar" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="loser character"></input>
					<input id="wStock" type="number" class="form-control" style="margin-bottom:10px;" placeholder ="winner stock"></input>
					<input id="passwordLoser" type="password" class="form-control" style="margin-bottom:10px;" placeholder ="loser password"></input>
					<button id="record" class="btn btn-default" onClick="record();">Record</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>