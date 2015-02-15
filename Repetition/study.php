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
var front='';
var back='';
var id='';

xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		if(xmlhttp.responseText.indexOf('no more cards to study')>-1)
		{
			$('#card').html('no more cards to study');
			$('#ratingButtons').hide(200);
			$('#flip').hide(200);
		}
		else
		{
			var split=xmlhttp.responseText.split('~');
			front=split[0];
			back=split[1];
			id=split[2];
			$('#card').text(front);
			$('#ratingButtons').hide(200);
			$('#flip').show(200);
		}
	}
}
function answer(rating)
{
	xmlhttp.open("GET","/Repetition/getcard.php?d="+<?php echo '"'.$_GET['d'].'"'?>+"&i="+id+"&r="+rating,true);
	xmlhttp.send();
}
function flip()
{
	$('#ratingButtons').show(200);
	$('#card').text(back);
	$('#flip').hide(200);
}
$(document).ready(function(){
	xmlhttp.open("GET","/Repetition/getcard.php/?d="+<?php echo '"'.$_GET['d'].'"'?>,true);
	xmlhttp.send();
	});
</script>
<div class="container">
	<div class="starter-template">
		<h2><?php echo $_GET['n']?></h2><br>
		<div id="cardDiv">
			<label id="card">card</label><br><br>
			<div id="ratingButtons" hidden>
				Rate your response<br><br>
				<button onClick='answer(0);' class="btn btn-default">0</button>
				<button onClick='answer(1);' class="btn btn-default">1</button>
				<button onClick='answer(2);' class="btn btn-default">2</button>
				<button onClick='answer(3);' class="btn btn-default">3</button>
				<button onClick='answer(4);' class="btn btn-default">4</button>
				<button onClick='answer(5);' class="btn btn-default">5</button>
			</div><br>
			<button id="flip" class="btn btn-default" onClick="flip()">Flip</button>
		</div>
	</div>
</div>
</body>
</html>