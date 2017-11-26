<?php
//error_reporting(0);
//Mysql connect
$db = mysqli_connect("localhost", "root", "", "socialhub");
if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

include ('inc/header.php');
?>
