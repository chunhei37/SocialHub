
<?php
include("checkPermission.php");
echo '
<div class="card" style="margin: 10px;">
    <div class="card-body">
        <div class="small text-muted" style=""><a class="nounderline" href="profile.php?uid='.$temp.'"><img src = ".\uploads\\' . $temp . '\\' . mysqli_fetch_row(mysqli_query($db, "SELECT profilepic FROM aboutme where userID = '$temp'"))[0] . '" height="50" width="50"> <span class="card-title"><font size="4">'. mysqli_fetch_row(mysqli_query($db, "SELECT CONCAT_WS(\" \", firstName, lastName) AS fullName FROM user where userID = '$temp'"))[0] .'</font></span></a>

            <div class="dropdown float-right">
                <a class="float-right" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="fa fa-ellipsis-h fa-lg" aria-hidden="true"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item open-reportDialog" data-toggle="modal" data-target="#reportModal" data-id="' . $post['postID']. '">Report</a>';
        if(isset($_SESSION['admin']) && $_SESSION['admin']) {
            echo '<a class="dropdown-item open-deleteDialog" data-toggle="modal" data-target="#deleteModal" data-id="'. $post['postID'].'">Delete</a>';
        }
               echo' </div>
            </div>

        </div>
        <div id="post_content">
            <div class="small text-muted"><p style="text-align: left;">'. $dt->format('Y-m-d H:i:s') . '</p></div>
            <div id="post_content"><p>' . $post['content'] . '</p></div>
            <hr>
            <div class="card-text">
             <div class="row col-md-4">
                <div>
                <form id="likeOnPostForm" method="post" action=""><input type="hidden" name="likeOnPost" value="'. $post['postID'].'"/><a href="#" onclick="document.getElementById(\'likeOnPostForm\').submit();" class="btn btn-inverse"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></form>
                </div>
               <div> <a href="#" class="btn btn-inverse disabled"><i class="fa fa-share" aria-hidden="true"></i></a></div>
                <div><a href="#" class="btn btn-inverse disabled"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
            </div>
            </div>
            <div class="card-footer text-muted">
                <!-- Post Comments -->
                <div>

                    <p style="margin-bottom: 0px;"> Example Comment</p>
                    <a href="#" class="btn btn-inverse" style="padding-top: 0px;"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
                </div>
                <textarea name="comment" class="form-control" placeholder="Add a comment..." rows="1" id="post" required></textarea>
            </div>
        </div>
    </div>
</div>
';
include ('inc/likeOnPost.php');
include('inc/report.php');
include ('inc/deletePost.php');
        ?>