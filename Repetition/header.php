<?php
include('login.php');
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="/bootstrap.min.js"></script> 
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="/bootstrap.min.css" rel="stylesheet">
<link href="/Repetition/styles.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400' rel='stylesheet' type='text/css'>
<script>
/*var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    $("#logout").text(xmlhttp.responseText);
  } 
}
function logout()
{
  xmlhttp.open("GET","./logout.php",true);
  xmlhttp.send();
}*/
function logout()
{
  window.location.href="./logout.php";
}
</script>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/Repetition">Repetition</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="/Repetition/decks.php">Decks</a></li>
        <li><a href="/Repetition/browse.php">Browse</a></li>
        <li><a href="/Repetition/about.php">About</a></li>
        <li><a href="/Repetition/create.php">Create Account</a></li>
        <li><a href="/Repetition/password.php">Change Password</a></li>        
      </ul>
      <?php
      if(!isset($_SESSION['user']))
      {echo
      '<form class="navbar-form navbar-right" method="post">
          <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
          <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-default">Sign In</button>
      </form>';
      }
      else
      {
        echo
        '<div class="navbar-form navbar-right"><div class="form-group">Welcome, '.$_SESSION['user'].
        '&nbsp;&nbsp;&nbsp;</div><div class="form-group"><button type="button" onClick="logout()" class="btn btn-default">Log Out</button></div></div>';
      }
      ?>
    </div>
  </div>
</div>