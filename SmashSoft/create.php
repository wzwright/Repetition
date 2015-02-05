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
			$("#lbl").html(xmlhttp.responseText);
			$("#lbl").show(300);
		}
	}
	function playerClick()
	{
		var reg=/\W+/;
		if(!reg.test($("#username").val())&!reg.test($("#password").val())&!reg.test($("#realname").val()))
		{
			$("#playerdiv").addClass('has-success').removeClass('has-error');
			xmlhttp.open("GET","./addplayer.php?a=y&n="+$("#username").val()+"&p="+$("#password").val()+"&rn="+$("#realname").val(),true);
			xmlhttp.send();
			$("#lbl").hide(300);
		}
		else{
			$("#playerdiv").addClass('has-error').removeClass('has-success');
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
			<div id="playerdiv" class="col-md-4">New Player
				<input onkeyup="validate('#realname');" style="margin-bottom:10px; margin-top:10px;" id="realname" type="text" class="form-control" placeholder="name"></input>
				<input onkeyup="validate('#username');" style="margin-bottom:10px; margin-top:10px;" id="username" type="text" class="form-control" placeholder="username"></input>
				<input onkeyup="validate('#password');" style="margin-bottom:10px;" id="password" type="password" onkeydown="" class="form-control" placeholder="password"></input>
				<button class="btn btn-default" onClick="playerClick();" id="player">Add Player</button>
			</div>
			<div class="col-md-4">
				<label id="lbl"></lbl>
			</div>
		</div>
	</div>
</body>
</html>