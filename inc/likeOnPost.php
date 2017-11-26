<?php
/**
 * Created by PhpStorm.
 * User: ChunHei
 * Date: 11/3/2017
 * Time: 8:25 AM
 */
include("checkPermission.php");
if(isset($_POST['likeOnPost'])) {
    $sql = "Select * From likeonpost Where likeby='$uid'";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) < 1){
        $time = time();
        $pid = $_POST['likeOnPost'];
        $sql = "insert into likeonpost (likeBy, postID, epochTime) values ('$uid', '$pid' ,'$time')";
        if(mysqli_query($db, $sql)) {

        }
    }

}
?>