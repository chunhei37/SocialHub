<html>
<head>
</head>
<body>
<?php
session_start(); 
include("config.php");
include('navbar.php');

if(!isset($_SESSION['uid'])) {
	include('register.php'); 
} else {
	include('feeds.php');
}
		 
?>
</body>
</html>