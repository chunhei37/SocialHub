<?php session_start();
// delete all session
session_destroy(); 
echo 'Logout......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>