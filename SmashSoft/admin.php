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
			$("#lbl").html(xmlhttp.responseText);
			$("#lbl").show(300);
		}
	};
	function addClick()
	{
		var date= $.datepicker.parseDate("yy-mm-dd", $("#date").val());
		xmlhttp.open("GET","./addevent.php?n="+$("#name").val()+"&s="+$("#setups").val()+"&d="+(date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate()),true);
		xmlhttp.send();
	}
	function playerClick()
	{
		var reg=/\W+/;
		if(!reg.test($("#username").val())&&!reg.test($("#password").val())&&!reg.test($("#realname").val()))
		{
			$("#playerdiv").addClass('has-success').removeClass('has-error');
			xmlhttp.open("GET","./addplayer.php?n="+$("#username").val()+"&p="+$("#password").val()+"&rn="+$("#realname").val(),true);
			xmlhttp.send();
			$("#lbl").hide(300);
		}
		else{
			$("#playerdiv").addClass('has-error').removeClass('has-success');
		}
	}
	function appsClick(username,realname,password,accept)
	{
		if(accept=="1"){
			xmlhttp.open("GET","./addplayer.php?n="+username+"&p="+password+"&rn="+realname,true);
			xmlhttp.send();
			$("#lbl").hide(300);
		}
		else{
			xmlhttp.open("GET","./rejectplayer.php?n="+username,true);
			xmlhttp.send();
			$("#lbl").hide(300);
		}
	}
	function validate(source)
	{
		var reg=/\W+/;
		if(!reg.test($(source).val()))
		{
			$(source).parent().addClass('has-success').removeClass('has-error');
		}
		else{
			$(source).parent().addClass('has-error').removeClass('has-success');
		}
	}
	</script>
	<div class="container">
		<div class="starter-template">
			<div id="lbl" style="margin-bottom:10px">Further admin tools coming</div>
			<div class="col-md-3">New Event
				<input onkeyup="validate('#name')" style="margin-bottom:10px; margin-top:10px;" id="name" type="text" class="form-control" placeholder="Name"></input>
				<input style="margin-bottom:10px;" id="date" type="date" class="form-control" placeholder="Date"></input>
				<input style="margin-bottom:10px;" id="setups" type="number" class="form-control" placeholder="Setups"></input>
				<button class="btn btn-default" onClick="addClick();" id="add">Add Event</button>
			</div>
			<div id="playerdiv" class="col-md-3">New Player (alphanumeric pls)
				<input onkeyup="validate('#realname');" style="margin-bottom:10px; margin-top:10px;" id="realname" type="text" class="form-control" placeholder="name"></input>
				<input onkeyup="validate('#username');" style="margin-bottom:10px; margin-top:10px;" id="username" type="text" class="form-control" placeholder="username"></input>
				<input onkeyup="validate('#password');" style="margin-bottom:10px;" id="password" type="password" onkeydown="" class="form-control" placeholder="password"></input>
				<button class="btn btn-default" onClick="playerClick();" id="player">Add Player</button>
			</div>
			<div class="col-md-6">
				<?php
				$con=mysqli_connect();
				if (mysqli_connect_errno()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					exit;
				}
				$query= "SELECT name, realname, password FROM playersapps";
				$result=mysqli_query($con,$query);
				echo "<table class='table table-striped table-bordered'><tr><td>Name</td><td>Username</td><td>Password</td></tr>";
				while($row=mysqli_fetch_array($result))
				{
					echo '<tr><td>'.$row['realname'].'</td><td>'.$row['name'].'</td><td>'.$row['password'].'</td><td><button class="btn btn-default" onClick="appsClick(\''.$row['name'].'\',\''.$row['realname'].'\',\''.$row['password'].'\',\'1\');">Accept</button></td><td><button class="btn btn-default" onClick="appsClick(\''.$row['name'].'\',\'\',\'\',\'0\');">Reject</button></td></tr>';
				}
				echo "</table>";
				?>
			</div>
		</div>
	</div>
</body>
</html>