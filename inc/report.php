<script>
    $(document).on("click", ".open-reportDialog", function () {
        var myReportID = $(this).data('id');
        $(".modal-body #reportID").val( myReportID );
    });
</script>

<div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
     aria-labelledby="reportModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Report A Post</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <label >Tell us why?</label>
                    <textarea name="reportContent" class="form-control" rows="3" placeholder="Type here"></textarea>
                    <input name="reportID" id="reportID" type="hidden">
            </div>
            <div class="modal-footer">
                <input class="form-control" type="submit" name="reportSubmit" value="Report">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
/**
 * Created by PhpStorm.
 * User: ChunHei
 * Date: 11/3/2017
 * Time: 6:33 AM
 */

if(isset($_POST['reportSubmit'])) {
    $content = $_POST['reportContent'];
    $postID = $_POST['reportID'];
    $sql = "insert into report (postID, content,reportBy) values ('$postID', '$content','$uid')";
    if(mysqli_query($db, $sql)) {
    } else {
        echo '
        <div class="alert alert-danger" role="alert">
  <strong>Oh snap!</strong> Failed to report! Please contact the admin.
</div>';
    }
}
?>