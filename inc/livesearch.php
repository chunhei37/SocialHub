<?php
include ('../config.php');

if(isset($_REQUEST['term'])){
    // Prepare a select statement
    $keyword = mysqli_real_escape_string($db,  $_REQUEST['term']);
    $sql = "SELECT * FROM user where (LOWER(firstName) like LOWER('%$keyword%') OR LOWER(lastName) like LOWER('%$keyword%'))";

    if($result = mysqli_query($db, $sql)){
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $temp = $row['userID'];
                    echo '<p><a href="profile.php?uid='.$temp.'"><img src = ".\uploads\\' . $temp . '\\' . mysqli_fetch_row(mysqli_query($db, "SELECT profilepic FROM aboutme where userID = '$temp'"))[0] . '" height="50" width="50">';
                    echo  $row["firstName"] . ' ' . $row["lastName"] . '</a></p>';
                }
            } else{
                echo "<p>No matches found</p>";
            }
    }
}
// close connection
mysqli_close($db);
?>