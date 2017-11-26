<script>
    $(document).on("click", ".open-deleteDialog", function () {
        var myDeleteID = $(this).data('id');
        $(".modal-body #deleteID").val( myDeleteID );
    });
</script>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
     aria-labelledby="deleteModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Post?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input name="deleteID" id="deleteID" type="hidden">
            </div>
            <div class="modal-footer">
                <input class="form-control" type="submit" name="deleteSubmit" value="delete">
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
 * Time: 9:59 AM
 */
if(isset($_POST['deleteID'])) {
    $postID = $_POST['deleteID'];
    $sql = "Delete From post where postID = '$postID'";
        if(mysqli_query($db, $sql)) {
            echo '<meta http-equiv=REFRESH CONTENT=0;>';
        }



}

?>