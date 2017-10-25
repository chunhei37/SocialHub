<?php
/**
 * Created by PhpStorm.
 * User: ChunHei
 * Date: 10/25/2017
 * Time: 3:22 AM
 */
session_start();
include("config.php");
if(!isset($_SESSION['uid'])) {
    header( 'Location: ./index.php' );
}
?>