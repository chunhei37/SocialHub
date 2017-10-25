<?php
session_start(); 
include("config.php");
$uid = $_SESSION['uid']; 
$curtown = $_POST['curtown'];
$curWork = $_POST['curWork'];
$prevWork = $_POST['prevWork'];
$hometown = $_POST['hometown'];
$gender = $_POST['gender'];
$phoneno = $_POST['phoneno'];
$about = $_POST['aboutme'];

if(isset($_POST['gender'])) {
	
$sql = "UPDATE user SET user_currentLivingTown = '$curtown', user_currentWork = '$curWork', user_prevWork = '$prevWork', user_hometown = '$hometown', user_gender = '$gender', user_phoneNum = '$phoneno', user_about = '$about' WHERE user_id = '$uid'";
if(mysqli_query($db, $sql)) {
	echo "OK";
} else {
	echo "Fail!";
}
}


	?>