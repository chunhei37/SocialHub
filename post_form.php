 <form id="postForm" name="postForm" action="" method="post">
            <div class="form-group" style="margin-bottom: 2px;">
                <textarea name="postContent"class="form-control" placeholder="What's on your mind?" rows="3" id="post" required=""></textarea>
            </div>
            <div style="float: right;">
                <button type="submit" class="btn btn-secondary" style="margin-top: 8px; margin-left: 15px;">
                    Attach Picture
                </button>
                <button name="postSubmit" type="submit" class="btn btn-primary" style="margin-top: 8px; margin-left: 15px;">Post
                </button>
            </div>
 </form>
<?php
/**
 * Created by PhpStorm.
 * User: ChunHei
 * Date: 10/27/2017
 * Time: 11:34 AM
 */
if(isset($_POST['postSubmit'])) {
    $content = $_POST['postContent'];
    $uid = $_SESSION['uid'];
    $pid = sha1(uniqid() . time());
    $time = time();
    $sql = "insert into post (postID, userID, content, createdTime) values ('$pid' , '$uid', '$content', '$time')";
    if(mysqli_query($db, $sql)) {
        echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
    } else {

    }
}

?>