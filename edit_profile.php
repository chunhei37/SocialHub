<?php
session_start();
include("checkPermission.php");
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
$row = @mysqli_fetch_assoc($result);
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





?>