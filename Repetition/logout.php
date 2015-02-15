<?php
session_start();
echo session_destroy()?"logged out":"logout failed"; // Destroying All Sessions
header("Location:index.php");
?>