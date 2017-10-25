<?php
session_start();
include ("checkPermission.php");
include("config.php"); 
$uid = $_SESSION['uid']; 
include('navbar.php');
?>
   <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
<?php
$sql = "SELECT * FROM user where user_id = '$uid'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
if(!is_null($row['user_pic'])) {
	echo '<img class="text-center" src=.\uploads\\' . $uid . '\\' .$row['user_pic'] . ' height="180" width="180">';
} else {
	echo '<img class="text-center" src=".\img\person-placeholder.jpg"height="180" width="180">';
}
?> </div>
        <div class="col-md-4"></div>
          </div>
          <div class="row">
             <div class="col-md-6">
              <form action="upload_action.php" method="post" enctype="multipart/form-data" class="text-center">
                <input class="form-control" type="file" name="file" id="file" aria-describedby="fileHelp">
				</div>
			<div class="col-md-3">
                <input class="form-control text-center" type="submit" name="submit" value="Upload"> </form>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <h3>Edit Profile</h3>
          <form id="form" name="form" method="post" action="profile_update.php">
            <div class="form-group"> 
			 <div class="form-row">
			   <div class="col-md-6">
				<label>Current Work: </label>
              <input class="form-control" type="text" name="curWork" placeholder="<?php $row['user_currentWork']?>">
			  </div>
			                <div class="col-md-6">
			  	<label>Previous Work: </label>
              <input class="form-control" type="text" name="prevWork" placeholder="<?php $row['user_prevWork']?>">
			  </div>
			  </div>
              <br> 
			  			 <div class="form-row">
			   <div class="col-md-6">
			  <label>Current Live At: </label>
              <input class="form-control" type="text" name="curtown" placeholder="<?php $row['user_currentLivingTown']?>">
			  			  </div>
			                <div class="col-md-6">
			  <label>HomeTown: </label>
              <input class="form-control" type="text" name="hometown" placeholder="<?php $row['user_hometown']?>">
			  			  </div>
			  </div>
              <br> <label>Phone Number: </label>
              <input class="form-control" type="text" name="phoneno" placeholder="<?php $row['user_phoneNum']?>">
              <br> <label>Gender: </label><select class="form-control" name="gender" form="form"><option value="Female">Female</option><option value="Male">Male</option><option value="Other">Other</option></select>
              <br> <label>About me: </label>
			  <textarea class="form-control" name="aboutme" form="form"><?php $row['user_about']?></textarea>
              <br>
              <input class="btn btn-primary btn-block" type="submit" name="submit" value="Submit"> </div>
          </form>
        </div>
      </div>
    </div>
        </div>