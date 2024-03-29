<!-- THIS FILE CONTAINING ALL POST MODAL -->

<?php
    $classid = $_GET['class_id'];
?>
<!-- // ================================= DROPDOWN ACTION IN POST ============================================= // -->
<ul class="drop_down_menu">
    <a class="round-btn-cyan table_btn_right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></i></a>
    <div class="dropdown-menu dd_menu_content" id="dd_content">
    <div class="text-center margin-dropdown"><a type="button" id="edit_post_btn" data-target='#modal-update-post<?php echo $postID?>' data-toggle="modal" name="update_post_btn" href="#">Edit</a></div>
    <div class="text-center margin-dropdown"><a type='button' id="delete_post_btn" data-target='#modal-delete-post<?php echo $postID?>' data-toggle='modal' name='delete_post_btn' >Delete</a></div>
    </div>
</ul>

<!-- // ================================== Modal FOR DELETE POST PASSING ID ================================== //

     // ================================== PASS ID THROUGH MODAL ======================================= // -->

<div id="modal-delete-post<?php echo $postID;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
            </div>
            <div class="modal-body">
                <div>Are you sure you want to delete ?</div><br><p>All comments will be deleted !</p>
                <form action="./actions/post_handle.php?post_id=<?php echo $postID;?>&class_id=<?php echo $classid;?>" method="post">
                    <input name='delete_post_btn' type="submit" class="delete_post_btn" name = "btn_create_class" id="btn_create_class" value="Yes">
                </form>

                <input type= "button" class="class-delete-btn-no" data-dismiss="modal" value="No">

            </div>
        </div>
    </div>
</div>

<!--=================================================================================================================-->
<!--=================================================================================================================-->







<!-- ================================== Modal FOR UPDATE POST PASSING ID ================================== -->

<!-- ================================== PASS ID THROUGH MODAL ======================================= -->
<div id="modal-update-post<?php echo $postID ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
            </div>
            <div class="modal-body">
                <form action="./actions/post_handle.php?post_id=<?php echo $postID?>&class_id=<?php echo $classid?>" method="post">
                    <textarea name="post_content_update" id="comments_textarea" placeholder="Share with your class" oninput='this.style.height = "";this.style.height = this.scrollHeight + 3 +  "px"' cols="50" ></textarea>
                    <div class="post_file">
                        <input id="file_btn_comment" type="file" name="file_btn_comment" multiple="multiple" onchange="uploadOnChange()">
                    </div>
                    <div class="post_edit_submit_btn">
                        <input type= "button" class="class-update-btn-no" data-dismiss="modal" value="Cancel">
                        <input name='update_post_btn' type="submit" class="update_post_btn" value="Post">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--=================================================================================================================-->
<!--=================================================================================================================-->