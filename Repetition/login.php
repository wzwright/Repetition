<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if(isset($_POST['username'])||isset($_POST['password']))
{
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$con=mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
// SQL query to fetch information of registerd users and finds user match.
$result = mysqli_query($con,"SELECT * FROM users WHERE pass='".$password."' AND name='".$username."'");
$rows = mysqli_num_rows($result);
if ($rows == 1) {
$_SESSION['user']=$username; // Initializing Session
} else {
$error = "Username or Password is invalid";
}
mysqli_close($con); // Closing Connection
}
?>