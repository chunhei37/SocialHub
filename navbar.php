<style type="text/css">
    .search-box{
        width: 500px;
        position: relative;
        display: inline-block;
    }

    .result{
        background-color: white;
        position: absolute;
        z-index: 99;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }

    .navmsg {
        display: block;
        width: 100px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .astext {
        background:none;
        border:none;
        margin:0;
        padding:0;
    }

</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("inc/livesearch.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Social Hub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

        <?php
        if (!isset($_SESSION['uid'])) {
            echo '<ul class="navbar-nav ml-auto"><li class="nav-item dropdown">';
            echo '<li class="nav-item"><form name="form" method="post" action="login_action.php"></li><input class="form-control" aria-describedby="emailHelp" type="text" name="email" placeholder="Enter email" required/></li><input class="form-control" type="password" name="password1" placeholder="Enter password" required/><li class="nav-item"><input class="btn btn-primary btn-block" type="submit" name="button" value="Login" /></form></li>';
        } else {
            $uid = $_SESSION['uid'];
            //search
            echo '<form class="col-md-6" name="searchForm" method="post" action="search.php" style="padding-top: 10px"><div class="custom-search-input"><div class="input-group">';
            echo '<div class="search-box"><input type="text" class="form-control input-lg" name="keyword" autocomplete="off"><div class="result" id="result"></div></div><span class="input-group-btn"><button class="btn btn-info btn-lg" name="searchSubmit" type="submit"><i class="fa fa-search"></i></button></span>';
            echo '</div></div></form>';
            echo '<ul class="navbar-nav ml-auto"><li class="nav-item dropdown">';
//Messages

            $sql = "SELECT  * FROM message where relatedID = '$uid' ORDER BY time DESC LIMIT 1";
            $result = mysqli_query($db, $sql);
            echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="dropdown-divider"></div>';
                echo '<a class="dropdown-item" href="message.php?mid=' . $row['msgID'] . '">';
                $temp = $row['creatorID'];
                echo '<strong href="profile.php?=">' . mysqli_fetch_row(mysqli_query($db, "SELECT CONCAT_WS(\" \", firstName, lastName) AS fullName FROM user where userID = '$temp'"))[0] . '</strong>';
                echo '<span class="small float-right text-muted">' . $row['time'] . '</span><br><br>';
                echo '<div class="dropdown-message"><span class="navmsg">' . $row['content'] . '</span></div></a>';
            }
            echo '<div class="dropdown-divider"></div><a class="dropdown-item small" href="#">View all messages</a></div></li>';

            $sql = "Select * from relationship where (userID1 = '$uid' OR userID2 = '$uid') And relation = 0";
            $result = mysqli_query($db, $sql);
//Notification
            echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="friendDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-users"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="friendDropdown">
            <h6 class="dropdown-header">Friend Request:</h6>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="dropdown-divider"></div>';
                if($row['userID1'] == $uid) {
                    $temp = $row['userID2'];
                } else {
                    $temp = $row['userID1'];
                }
                echo '<strong href="profile.php?=">' . mysqli_fetch_row(mysqli_query($db, "SELECT CONCAT_WS(\" \", firstName, lastName) AS fullName FROM user where userID = '$temp'"))[0] . '</strong>';
                echo '<div class="dropdown-message"><form id="fdform" method="post"><input type="hidden" name="fid" value="'. $row['id'] .'"><button class="astext" type="submit" name="fdSubmit" value="Accept">Accept</button>
<button class="astext" type="submit" name="fdSubmit" value="Decline">Decline</button></form></div>';
            }

            echo '</a></div></li>';
//Logout
            echo '<li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>';
        }
        ?>
        </ul>
    </div>
</nav>
<br>
<br>
<br>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>

<?php

if(isset($_POST['fdSubmit'])) {
    $r = $_POST['fdSubmit'];
    $f = $_POST['fid'];
   if($r == "Accept") {
      $sql = "UPDATE relationship SET relation = 1 WHERE id = $f";
    } else {
       $sql = "DELETE FROM relationship WHERE id = $f";
    }
    mysqli_query($db, $sql);
   echo '<meta http-equiv=REFRESH CONTENT=1>';
}
?>