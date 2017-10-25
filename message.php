<?php
session_start(); 
include("config.php");
include('navbar.php');
$uid = $_SESSION['uid']; 

if($_GET['mid']) {
	$mid = $_GET['mid'];
		$sql = "SELECT * FROM message where msg_id = '$mid'";
		$result = mysqli_query($db, $sql);
	echo '  <div class="container">
    <div class="card mx-auto mt-5">';
		while($row = mysqli_fetch_assoc($result)) {

			$temp = $row['msg_creatorId'];
            echo '<strong href="profile.php?=">'. mysqli_fetch_row(mysqli_query($db, "SELECT user_name FROM user where user_id = '$temp'"))[0] .'</strong>';
            echo '<span class="small float-right text-muted">' . $row['msg_time'] .'</span>';
			echo '<div class="dropdown-message">' .$row['msg_content'] . '</div></a>';
		}
		
		
		echo '<form id="form" name="form" method="post" action=""> <textarea class="form-control" name="message" form="form"> </textarea>  <br>
              <input class="btn btn-primary btn-block" type="submit" name="submit" value="Submit"> </div></form>';
		  
		echo  '</div></div>';
}
	

if(isset($_POST['submit'])){ //check if form was submitted
  $message = $_POST['message']; //get input text

$sql = "insert into message (msg_id, msg_content, msg_creatorId, msg_relatedId) values ('$mid', '$message', '$uid', '$temp')";
if(mysqli_query($db, $sql)) {
	echo '<meta http-equiv=REFRESH CONTENT=1;url=message.php?mid='. $mid .'>';
	
}
}    


?>