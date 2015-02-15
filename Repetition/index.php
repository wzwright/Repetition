<html>
<head>
	<title></title>
</head>
<body>
<?php
include_once("header.php");
if(isset($_SESSION['user']))
	include_once("decks.php");
else
	echo '<br>&nbsp;&nbsp;&nbsp;please log in!';
?>
</body>
</html>