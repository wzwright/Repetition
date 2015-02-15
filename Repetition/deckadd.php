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
		$('#front').val("");
		$('#back').val("");
		$('#front').focus();
	}
}

function change(){
	$("#lbl").hide(300);
	xmlhttp.open("GET","/Repetition/addtodeck.php?d="+<?php echo $_GET['d']?>+"&f="+$("#front").val()+"&b="+$("#back").val(),true);
	xmlhttp.send();
}
</script>
<div class="container">
	<div class="starter-template col-md-4">
	   	<label id="lbl" style="width:100%; display:none;"></label>
		<textarea rows="2" id="front" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="front"></textarea>
		<textarea rows="2" id="back" type="text" class="form-control" style="margin-bottom:10px;" placeholder ="back"></textarea>
		<button id="create" class="btn btn-default" onClick="change();">Add to <?php echo $_GET['n']?></button>
	</div>
</div>
</body>
</html>