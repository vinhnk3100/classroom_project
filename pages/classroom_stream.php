<?php
session_start();
if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}

//===================================== Connect to Database =====================================
require ('actions/database.php');

// Get ID
$classid = $_GET['class_id'];
$uid = $_SESSION['uid'];

// Query for showing class infomation, name, teacher
$queryClass = "SELECT * FROM class, users WHERE class.class_id = '$classid' AND users.user_id = class.teacher_id" ;
$resultClass = mysqli_query($db,$queryClass);
$rowsClass = mysqli_fetch_assoc($resultClass);

// Query for showing class through Session ID
$queryUID = "SELECT * FROM class,users WHERE  class.teacher_id = users.user_id AND class.teacher_id = '$uid'";
$resultUID = mysqli_query($db,$queryUID);

$queryCreator = "SELECT * FROM users, class WHERE users.user_id = class.teacher_id AND class.teacher_id = '$uid' ";
$resultCreator = mysqli_query($db,$queryCreator);

// SQL get post query
$queryPost = "SELECT * FROM post WHERE class_id='$classid'";
$post_exec = mysqli_query($db,$queryPost);


require("Initials.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Classroom</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/classroom-stream.css">
    <link rel="stylesheet" type="text/css" href="./css/util.css">
    <link rel="stylesheet" type="text/css" href="./css/modal-form.css">

</head>

<body>
<main>
    <?php include ("./function/nav-bar-actions-class.php")?>
    </nav>
    </div>


    <!--====== NAVBAR TOP =======================-->

    <!--=================================================================================================================-->
    <!--=================================================================================================================-->

    <!--======Nav_bar_2=======-->
    <div class="nav_bar_2">
        <div class="nav_bar_2_item">
            <?php
            echo "<a class=\"nav_bar_2_text_a\" href=\"classroom_stream.php?class_id=$classid\" target=\"_self\"> Stream
            </a>";
            ?>

        </div>
        <div class="nav_bar_2_item">
            <?php
            echo "<a class=\"nav_bar_2_text_b\" href=\"classroom_everyone.php?class_id=$classid\" target=\"_self\"> Everyone
            </a>";
            ?>
        </div>

    </div>
    <!--=================================================================================================================-->
    <!--=================================================================================================================-->

    <!--======Classroom UI=====-->
    <div class="classuis">
        <div class="classui">
            <div class="collapsible">

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!--======Classroom IMAGE BACKGROUND=====-->
                <img class="classuib" src="./css/backgroundImages/<?php echo $rowsClass["classAvatar"]; ?>" alt="">
                <div class="class-content">
                    <div class="class-title">
                        <div>
                            <em><a href="#modal-insert-image" data-toggle="modal"><i class="fa fa-cog" aria-hidden="true"></i></a></em>
                        </div>
                        <div class="custom_image_text">
                            <?php
                                if($_SESSION['role'] == 'adm' || $_SESSION['role'] == 'tea'){
                                    echo "<em><a href=\"#modal-insert-image\" data-toggle=\"modal\"><i class=\"fa fa-camera style-fa\"></i></a></em>";
                                }
                            ?>
                        </div>
                    </div>
                    <h1 class="class-top-title shaded_background">
                        <?php echo $rowsClass["className"]?>
                    </h1>
                    <div class="class-title">
                        <div class="shaded_background"><?php echo $rowsClass["fullName"]?></div>
                    </div>
                    <?php
                    echo "<div class=\"class-code\">
                                    <em class=\"class-code-text shaded_background\">Class code : $classid</em>
                                </div>";
                    echo "
                        <button onclick='showClassInforms()' class='btn btn-outline-success btn_classstream'><i class='fa fa-arrow-circle-down'></i></button>";
                    ?>
                </div>

                <!-- SHOWING CLASS INFORMATION -->

                <div class="class-information">
                    <div class="class-information-text">
                        <em>Subject :</em> <?php echo $rowsClass["subject"]?>
                    </div>
                    <div class="class-information-text">
                        <em>Room :</em> <?php echo $rowsClass["classRoom"];?>
                    </div>
                </div>
            </div>
            <!--=================================================================================================================-->
            <!--=================================================================================================================-->
        </div>



        <!--=================================================================================================================-->
        <!--=================================================================================================================-->

        <!-- Modal for INSERT BACKGROUND CLASS IMAGE  -->
        <div id="modal-insert-image" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Insert Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="insert-image-form" action="./actions/store_class_image.php?class_id=<?php echo $rowsClass['class_id']; ?>"  method="post" runat="server" enctype="multipart/form-data">
                            <label>Upload :</label>
                            <div class="form-group">
                                <input onclick="getImage()" type="file" class="form-control" id="images-class-background" name="classImg" required="required">
                                <img id="image-class-preview" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block btn-lg" name = "btn_upload_class_image" value="Upload">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL FOR INSERT BACKGROUND CLASS IMAGE -->

        <!--=================================================================================================================-->
        <!--=================================================================================================================-->
    </div>

    <!--====== POST CREATE ========================================-->
    <div class="classuis hide_comment_area">
        <div class="comment-area">
            <div class="nav-link" aria-haspopup="true" aria-expanded="false">
                <?php
                $initials = new Initials();
                $generateName = $initials->generate($_SESSION['fullname']);
                echo "<div class='circle circle-avt-comments'><div class='initials'>$generateName</div></div>"
                ?>
            </div>
            <label class="comment-label" onclick="showClassComment()">
                Say something to share with you class...
            </label>
        </div>

    </div>
    <!--Create Post Form-->
    <div class="classuis comment_show">
        <div class="comment-content">
            <form action="./actions/post_handle.php?class_id=<?php echo $rowsClass['class_id']; ?>" method="post">
                <textarea placeholder="Say something to share with your class...." id="comments_textarea" name="comments_textarea" oninput='this.style.height = "";this.style.height = this.scrollHeight + 3 +  "px"' cols="138"></textarea>
                <input id="post_btn_create" name="post_btn_create" value="Post" type="submit">
            </form>
            <input id="file_btn_comment" type="file" name="file_btn_comment" multiple="multiple" onchange="uploadOnChange()">
            <input id="cancel_btn_comment" value="Cancel" type="submit" onclick="showClassComment()">
            <div id="display_file_comment"></div>
        </div>
    </div>


    <!--====== END POST CREATE ========================================-->

    <!--====== POST ========================================-->
    <?php
    // SQL Select post query
                while($post_result = mysqli_fetch_assoc($post_exec)){
        ?>
    <div class="classuis" id="<?php echo $post_result['post_id'] ?>">
        <div class="post" >
                <div class="nav-link p-l-26\" aria-haspopup='true' aria-expanded='false'>
                    <?php
                    // SQL get user query
                    $postID = $post_result['post_id'];
                    $queryUser = "SELECT fullName FROM users,post WHERE users.user_id = post.user_id AND post_id='$postID'";
                    $user_exec = mysqli_query($db,$queryUser);
                    $user_result = mysqli_fetch_assoc($user_exec);
                    $initials = new Initials();
                    $generateName = $initials->generate($_SESSION['fullname']); ?>

                    <!-- ===================================== DROPDOWN MENU POST ACTION ===================================== -->
                         <ul class="drop_down_menu">
                            <a class="round-btn-cyan table_btn_right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></i></a>
                            <div class="dropdown-menu dd_menu_content" id="dd_content">
                                <div class="text-center margin-dropdown"><a id="update_post_btn" name='update_post_btn' data-target='#modal-update-post<?php echo $postID ?>' data-toggle='modal' href='#modal-update-post' >Edit</a></div>
                                <div class="text-center margin-dropdown"><a type='button' id="delete_post_btn" data-target='#modal-delete-post<?php echo $postID ?>' data-toggle='modal' href='#modal-delete-post' name='delete_post_btn' >Delete</a></div>            
                            </div>
                        </ul>

                    <!-- ================================== Modal FOR DELETE POST PASSING ID ================================== -->

                    <!-- ================================== PASS ID THROUGH MODAL ======================================= -->
                        <div id="modal-delete-post<?php echo $postID ?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div>Are you sure you want to delete ?</div><br><p>All comments will be deleted !</p>
                                            <form action="./actions/post_handle.php?post_id=<?php echo $postID?>&class_id=<?php echo $classid?>" method="post">
                                                <input name='delete_post_btn' type="submit" class="delete_post_btn"  value="Yes">
                                            </form>
                                            <input type= "button" class="class-delete-btn-no" data-dismiss="modal" value="No">
                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!--=================================================================================================================-->
                        <!--=================================================================================================================-->




                    <!-- ================================== Modal FOR DELETE POST PASSING ID ================================== -->

                    <!-- ================================== PASS ID THROUGH MODAL ======================================= -->
                    <div id="modal-delete-post<?php echo $postID ?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div>Are you sure you want to delete ?</div><br><p>All comments will be deleted !</p>
                                            <form action="./actions/post_handle.php?post_id=<?php echo $postID?>&class_id=<?php echo $classid?>" method="post">
                                                <input name='delete_post_btn' type="submit" class="delete_post_btn"  value="Yes">
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








                    <div class='post_user_name'> <?php echo $user_result['fullName'] ?>
                    <!--Post create date -->
                    <div class="post_date"><?php 
                    $postDate = date("j M", strtotime($post_result['dateT_current']));
                    $postDateUpdate = date("j M", strtotime($post_result['dateT_update']));
                    $postDate .= '(Edited on' .$postDateUpdate . ')';
                    echo $postDate;
                     ?></div>
                    </div>      
                    <!--<div class='circle circle-avt-post'><div class='initials'></div></div>-->
                    <img class="circle circle-avt-post" src='css/images/avatar/avatar.jpg' alt=''>
                </div>
                
                <div class="post_content">
                    <?php  
                        echo $post_result['content'];
                    ?>
                </div>
      
            <hr>

                <!-- Chứa họ tên, avatar, nội dung comment ( không up file được ) của người comment bài post trên -->
                <div class="post_expand_comments">Click to see more comments....
            </div>
            <div class="post_comments">
                <div class="nav-link" aria-haspopup="true" aria-expanded="false">
                    <?php
                    $initials = new Initials();
                    $generateName = $initials->generate($_SESSION['fullname']);
                    // Họ tên và ảnh ở đây
                    echo "<div class='post_user_name'>Nguyen Van A</div>";
                    echo "<div class='circle circle-avt-comments avt_in_post'><div class='initials name_in_post'>$generateName</div></div>";

                        // Nội dung comment ở đây !
                    echo "<div class='post_comments_users'>Lorem Ipsum is psum ipsum ipsum isimply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</div>";
                    ?>
                </div>
            </div>
            <!--======END POST COMMENTS ========================================-->

            <hr>

            <!--====== CREATE POST COMMENTS ========================================-->
                <!-- Chứa input comment của người đang log hiện tại -->
            <div class="nav-link p-l-26" aria-haspopup="true" aria-expanded="false">
                <?php
                $initials = new Initials();
                $generateName = $initials->generate($_SESSION['fullname']);?>
                <div class='circle circle-avt-comments avt_in_post'><div class='initials name_in_post'><?php echo $generateName?></div></div>
                <form action='./actions/post_comment_handle.php?class_id=<?php echo $rowsClass['class_id']; ?>' method='post' class='form_post_comments'>
                    <div class='input_comments' name='post_comment' contenteditable='true' data-text='Say something here....'></div>
                    <button class='post_comments_btn' name='post_comment_btn' type='submit'><i class='fa fa-paper-plane' aria-hidden="true"></i></button>
                </form>

                
            </div>

            <!--====== CREAT POST COMMENTS ========================================-->
           
        </div><!--END OF CLASS POST -->



    </div>
    <?php
            }
            ?>

    <!--====== END POST ========================================-->
    <br><br><br>


</main>

<footer>
    <script src="./js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</footer>
</body>
</html>