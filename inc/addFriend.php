<?php
/**
 * Created by PhpStorm.
 * User: ChunHei
 * Date: 11/25/2017
 * Time: 8:18 AM
 */

if(isset($_POST['friend'])) {
    $uid = $_SESSION['uid'];
    $uid2 = $_POST['friend'];

    $sql = "Select * from relationship where (userID1 = '$uid' OR userID2 = '$uid') And relation = 0";
    if(mysqli_num_rows(mysqli_query($db, $sql)) > 0) {
        echo "Friend request already sent!";
    } else {
        $sql = "insert into relationship (userID1, userID2) VALUE ('$uid', '$uid2')";
        if(mysqli_query($db, $sql)) {

        }
    }
}
?>