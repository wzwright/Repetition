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
	xmlhttp.open("GET","/Repetition/createdeck.php?n="+$("#name").val()+"&d="+$("#desc").val(),true);
	xmlhttp.send();
}
</script>
<div class="container">
	<div class="starter-template col-md-4">
     	<label id="lbl" style="width:100%; display:none;"></label>
		<textarea rows="1" id="name" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="deck name"></textarea>
		<textarea rows="4" id="desc" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="description"></textarea>
		<button id="create" class="btn btn-default" onClick="change();">Create Deck</button>
	</div>
</div>
</body>
</html>