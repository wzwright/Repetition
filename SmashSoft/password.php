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

function change(){
	$("#lbl").hide(300);
	if($("#newpass").val()!=$("#newpass2").val()){
		$("#lbl").show(300).delay(10).queue(function(next) { $("#lbl").text("passwords not the same"); next(); });
	}
	else
	{
		xmlhttp.open("GET","./changepass.php?np="+$("#newpass").val()+"&p="+$("#password").val()+"&u="+$("#username").val(),true);
		xmlhttp.send();
	}
}
</script>
<div class="container">
	<div class="starter-template">
		<div class="col-md-4">
			<label id="lbl" style="width:100%; display:none;"></label>
			<input id="username" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="username"></input>
			<input id="password" class="form-control" style="margin-bottom:10px;" type="password" placeholder="password"></input>
			<input id="newpass" class="form-control" style="margin-bottom:10px;" type="password" placeholder="new password"></input>
			<input id="newpass2" class="form-control" style="margin-bottom:10px;" type="password" placeholder="repeat new password"></input>
			<button id="change password" class="btn btn-default" onClick="change();">change password</button>
		</div>
	</div>
</div>
</body>
</html>