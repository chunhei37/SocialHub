 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Social Hub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
        <li class="nav-item">
		<?php
		if(!isset($_SESSION['uid'])) {
echo '<li class="nav-item"><form name="form" method="post" action="login_action.php"></li><input class="form-control" aria-describedby="emailHelp" type="text" name="email" placeholder="Enter email" /></li><input class="form-control" type="password" name="password1" placeholder="Enter passowrd" /><li class="nav-item"><input class="btn btn-primary btn-block" type="submit" name="button" value="Login" /></form></li>';
} else {
//Messages
	$uid = $_SESSION['uid']; 
		$sql = "SELECT  * FROM message where msg_relatedId = '$uid' ORDER BY msg_time DESC LIMIT 1";
		$result = mysqli_query($db, $sql);
		$total_results = mysqli_num_rows($result);
echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages</span>
			<span class="badge badge-notify">'. $total_results . '</span></a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>';

		while($row = mysqli_fetch_assoc($result)) {
			echo '<div class="dropdown-divider"></div>';
			echo '<a class="dropdown-item" href="message.php?mid='. $row['msg_id'] .'">';
			$temp = $row['msg_creatorId'];
            echo '<strong href="profile.php?=">'. mysqli_fetch_row(mysqli_query($db, "SELECT user_name FROM user where user_id = '$temp'"))[0] .'</strong>';
            echo '<span class="small float-right text-muted">' . $row['msg_time'] .'</span><br><br>';
			echo '<div class="dropdown-message">' .$row['msg_content'] . '</div></a>';
		}
echo '<div class="dropdown-divider"></div><a class="dropdown-item small" href="#">View all messages</a></div></li>';

//Notification
echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts</span>
			<span class="badge badge-notify">' . 0 .'</span></a>';
echo '</li>';
//Logout
echo '<li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>';
}
?>
        </li>
      </ul>
    </div>
  </nav>
  <br>
    <br>
	  <br>
	    <br>
      <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>