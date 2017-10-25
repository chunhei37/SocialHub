<?php
session_start();
include("config.php");
$uid = $_SESSION['uid']; 
	
$path = "uploads/". $uid;
if( !is_dir($path)) {
	mkdir($path);
}


$imageFileType = explode(".", $_FILES["file"]["name"]);
$filename = sha1($uid . uniqid() . "img") . "." . end($imageFileType);
if( move_uploaded_file($_FILES["file"]["tmp_name"], $path . "/" . $filename)) {
	$sql = "UPDATE user SET user_pic = '$filename' WHERE user_id = '$uid'";
	if(mysqli_query($db, $sql)) {
		echo "Upload Success!"; 
		echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
		} else {
			echo "Fail!";
		}
	} else {
		//fail msg bah bah bah 
	}
?>
