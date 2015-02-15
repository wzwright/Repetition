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

function change(){
	$("#lbl").hide(300);
	if($("#newpass").val()!=$("#newpass2").val()){
		$("#lbl").show(300).delay(10).queue(function(next) { $("#lbl").text("passwords not the same"); next(); });
	}
	else
	{
		xmlhttp.open("GET","./createaccount.php?p="+$("#newpass").val()+"&u="+$("#username").val(),true);
		xmlhttp.send();
	}
}
</script>
<div class="container">
	<div class="starter-template col-md-4">
     	<label id="lbl" style="width:100%; display:none;"></label>
		<input id="username" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="username"></input>
		<input id="newpass" class="form-control" style="margin-bottom:10px;" type="password" placeholder="password"></input>
		<input id="newpass2" class="form-control" style="margin-bottom:10px;" type="password" placeholder="repeat password"></input>
		<button id="create" class="btn btn-default" onClick="change();">Create Account</button>
	</div>
</div>
</body>
</html>