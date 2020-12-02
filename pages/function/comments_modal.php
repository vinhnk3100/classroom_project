<!-- THIS FILE CONTAINING ALL POST MODAL -->

<?php
$classid = $_GET['class_id'];
?>
<!-- // ================================= DROPDOWN ACTION IN POST ============================================= // -->
<ul class="drop_down_menu comment_button">
    <a class="round-btn-cyan table_btn_right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></i></a>
    <div class="dropdown-menu dd_menu_content" id="dd_content">
        <div class="text-center margin-dropdown"><a type='button' id="delete_post_btn" data-target='#modal-delete-comment<?php echo $commentID?>' data-toggle='modal' >Delete</a></div>
    </div>
</ul>

<!-- // ================================== Modal FOR DELETE COMMENT PASSING ID ================================== //

     // ================================== PASS ID THROUGH MODAL ======================================= // -->

<div id="modal-delete-comment<?php echo $commentID;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
            </div>
            <div class="modal-body">
                <div><strong>Are you sure you want to delete this comment ?</strong></div>
                <br>
                <br>
                <br>
                <form action="./actions/post_comment_handle.php?c_id=<?php echo $commentID;?>&class_id=<?php echo $classid;?>&post_id=<?php echo $postID?>" method="post">
                    <input name='post_comment_delete_btn' type="submit" class="delete_post_btn" name = "btn_create_class" id="btn_create_class" value="Yes">
                </form>

                <input type= "button" class="class-delete-btn-no" data-dismiss="modal" value="No">

            </div>
        </div>
    </div>
</div>

<!--=================================================================================================================-->
<!--=================================================================================================================-->
