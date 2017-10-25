
<?php

/*	
user_id
user_email
user_password
user_name
user_gender
user_birthday
user_prevWork
user_currentWork
user_latestEducation
user_hometown
user_currentLivingTown
user_phoneNum
user_sexualInterests
user_relationshipStatus
user_primaryLanguage
user_secondaryLanguage
user_religion
user_politics
user_about
user_pic
user_privacy
*/
include ("checkPermission.php");
$sql = "SELECT * FROM user where user_id = '$uid'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
if(!is_null($row['user_pic'])) {
	echo '<img class="text-center" src=.\uploads\\' . $uid . '\\' .$row['user_pic'] . ' height="180" width="180">';
} else {
	echo '<img class="text-center" src=".\img\person-placeholder.jpg"height="180" width="180">';
}

echo '<h1>'.$row['user_name'].'</h1>';
echo 'Lives in: ' . $row['user_currentLivingTown'];
echo '<br>From: ' . $row['user_hometown'];
echo '<br>PhoneNo.: ' . $row['user_phoneNum'];
echo '<br>About me: ' . $row['user_about'];
echo '<br><br><a href="edit_profile.php">EditProfile</a>';
?>
