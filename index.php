<?php 
session_start(); 
include("config.php");
include('navbar.php');
if(!isset($_SESSION['uid'])) {
	include('register.php'); 
} else {
	$uid = $_SESSION['uid']; 
	include('profile.php');
}
		 
?>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Social Hub 2017</small>
        </div>
      </div>
    </footer>



	