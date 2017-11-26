<?php
session_start();
include('config.php');
include('navbar.php');
include("checkPermission.php");

$gid = $_SESSION['uid'];
if(isset($_GET['uid'])) {
        $uid = $_GET['uid'];
    }

$sql = "SELECT * FROM user where userID = '$uid'";
$result = mysqli_query($db, $sql);
if(mysqli_num_rows($result) > 0) {
    $user = @mysqli_fetch_assoc($result);
} else {
    header('Loaction:index.php');
    exit();
}


$sql = "SELECT * FROM aboutme where userID = '$uid'";
$result = mysqli_query($db, $sql);
$about = @mysqli_fetch_assoc($result);

$fullname = $user['firstName'] . ' ' . $user['lastName'];

?>

    <style>
        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            -webkit-animation: fadeEffect 1s;
            animation: fadeEffect 1s;
        }

        /* Fade in tabs */
        @-webkit-keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }
    </style>
    <body class="container" style="padding-top: 30px">
    <?php
    if(!($uid == $gid)) {
        $sql = "Select * from relationship where (userID1 = '$gid' OR userID2 = '$gid') And relation = 1";
        if(mysqli_num_rows(mysqli_query($db, $sql)) > 0) {

        } else {
            echo '    
        <div class="pull-right ">
            <form action="" method="post">
                <input type="hidden" name="friend" value="'.$uid.'" />
                <input class="form-control text-center" type="submit" value="Add Friend">
            </form>
        </div>';
        }
    }
    ?>
    <div class="tab">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link tablinks active" onclick="openTab(event, 'Main')">Main</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tablinks" onclick="openTab(event, 'Photos')">Photos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tablinks" onclick="openTab(event, 'Friends')">Friends</a>
            </li>
        </ul>
    </div>

    <script>
        function openTab(evt, tabname) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabname).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
<div id="Main" class="tabcontent" style="display: block">
    <div class="row">
        <!-- Left pane that contains multiple cards with profile information -->
        <div class="col-sm-4" id="left_column">
            <!-- Profile summary section -->
            <div id="profile_card" class="card">
                <!-- Profile Picture -->
                <?php
                if (!is_null($about['profilepic'])) {
                    if($gid == $uid){
                        echo '<a data-toggle="modal" data-target="#uploadProfilePicModal"><img class="text-center" src=.\uploads\\' . $uid . '\\' . $about['profilepic'] . ' alt="Card image" style="max-height: 100%; max-width: 100%""></a>';
                    } else {
                        echo '<img class="text-center" src=.\uploads\\' . $uid . '\\' . $about['profilepic'] . ' alt="Card image" style="max-height: 100%; max-width: 100%">';
                    }
                } else {
                    if($gid == $uid){
                        echo '<a data-toggle="modal" data-target="#uploadProfilePicModal"><img class="card-img-top" src="img/placeholder_person.png" alt="Card image" ></a>';
                    } else {
                        echo '<img class="card-img-top" src="img/placeholder_person.png" alt="Card image" >';
                    }

                }
                ?>

                <div class="card-body">
                    <!-- Name -->
                    <h4 class="card-title text-center"><?php echo $fullname; ?></h4>
                    <!-- Bio -->
                    <p class="card-text small">Bio: <?php echo $about['bio']; ?></p>
                </div>
            </div>

            <!-- About section -->
            <div id="about_card" class="card">
                <div class="card-body">
                    <!-- Card Title -->
                    <h5 id="about_header" class="card-title text-center">About</h5>
                    <?php
                    if($gid === $uid){
                        echo '<a class="pull-right" data-toggle="modal" data-target="#editProfileModal">Edit</a>';
                    }
                   ?>
                    <!-- Location -->
                    <p class="card-text small about_details"> Lives in: <i><?php echo $about['currentAddress'] ?></i>
                    </p>
                    <!-- Work -->
                    <p class="card-text small about_details"> Work: <i><?php echo $about['currentWork'] ?></i></p>
                    <!-- Relationship Status -->
                    <p class="card-text small about_details"> Relationship:
                        <i><?php echo $about['relationshipStatus'] ?></i></p>
                </div>
            </div>
        </div> <!-- end left column -->
        <div class="col-sm-8" id="right_column">
            <!-- Profile Posts -->
            <div id="profile_card" class="card">
                <div class="card-body" style="padding: 15px 15px 10px 15px;">
                    <?php include('post_form.php'); ?>
                </div>
            </div>
            <!-- Posts by user -->
            <?php
            $sql = "Select * from post WHERE userID = '$uid' ORDER BY createdTime DESC";
            $result = mysqli_query($db, $sql);
            while ($post = @mysqli_fetch_assoc($result)) {
                $temp = $post['userID'];
                $dt = new DateTime("@" . $post['createdTime']);
                include ('post.php');
            }
            ?>
        </div>
    </div>
</div>
    </body>
    </html>
    <div class="modal fade" id="uploadProfilePicModal" tabindex="-1" role="dialog"
         aria-labelledby="uploadProfilePicModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadProfilePicModalLabel">Upload Your Profile Picture!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="upload_action.php" method="post" enctype="multipart/form-data" class="text-center">
                        <output id="filesInfo"></output>
                        <input class="form-control" type="file" name="file" id="file" aria-describedby="fileHelp"
                               accept="image/*" onchange="readURL(this);">
                        <br>
                        <img id="uimg" src="#" alt="Your Image" style="max-height: 100%; max-width: 100%"/>
                        <script type="text/javascript">
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#uimg')
                                            .attr('src', e.target.result)
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                </div>
                <div class="modal-footer">
                    <input class="form-control" type="submit" name="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" name="form" method="post" action="">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Current Work: </label>
                                    <input class="form-control" type="text" name="curWork"
                                           value="<?php $row['currentWork'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Previous Work: </label>
                                    <input class="form-control" type="text" name="prevWork"
                                           value="<?php $row['prevWork'] ?>">
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Current Live At: </label>
                                    <input class="form-control" type="text" name="curAdd"
                                           value="<?php $row['currentAddress'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Previous Live At: </label>
                                    <input class="form-control" type="text" name="prevAdd"
                                           value="<?php $row['prevAddress'] ?>">
                                </div>
                            </div>
                            <br> <label>Phone Number: </label>
                            <input class="form-control" type="text" name="phoneno" value="<?php $row['phoneNum'] ?>">
                            <br> <label>About me: </label>
                            <textarea class="form-control" name="aboutme" form="form" value="<?php $row['bio'] ?>"></textarea>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-primary btn-block" type="submit" name="updateProfile" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
include('inc/addFriend.php');
if (isset($_POST['updateProfile'])) {
    $uid = $_SESSION['uid'];
    $curAdd = $_POST['curAdd'];
    $curWork = $_POST['curWork'];
    $prevWork = $_POST['prevWork'];
    $prevAdd = $_POST['prevAdd'];
    $phoneno = $_POST['phoneno'];
    $about = $_POST['aboutme'];

    $sql = "UPDATE aboutme SET currentAddress = '$curAdd', prevAddress = '$prevAdd',currentWork = '$curWork', prevWork = '$prevWork', phoneNum = '$phoneno', bio = '$about' WHERE userID = '$uid'";
    if (mysqli_query($db, $sql)) {
        echo "<meta http-equiv=REFRESH CONTENT=1;url=profile.php>";
    }
}
?>