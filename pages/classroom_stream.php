<?php
session_start();
if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}

//===================================== Connect to Database =====================================
require ('actions/database.php');
$classid = $_GET['id'];

// Query for showing class infomation, name, teacher
$queryClass = "SELECT * FROM class, users WHERE class.class_id = '$classid' AND users.user_id = class.teacher_id" ;
$resultClass = mysqli_query($db,$queryClass);
$rowsClass = mysqli_fetch_assoc($resultClass);


$uid = $_SESSION['uid'];

// Query for showing class through Session ID
$queryUID = "SELECT * FROM class,users WHERE  class.teacher_id = users.user_id AND class.teacher_id = '$uid'";
$resultUID = mysqli_query($db,$queryUID);

$queryCreator = "SELECT * FROM users, class WHERE users.user_id = class.teacher_id AND class.teacher_id = '$uid' ";

$resultCreator = mysqli_query($db,$queryCreator);

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
            echo "<a class=\"nav_bar_2_text_a\" href=\"classroom_stream.php?id=$classid\" target=\"_self\"> Stream
            </a>";
            ?>

        </div>
        <div class="nav_bar_2_item">
            <?php
            echo "<a class=\"nav_bar_2_text_b\" href=\"classroom_everyone.php?id=$classid\" target=\"_self\"> Everyone
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
                            <em><a href="#modal-insert-image" data-toggle="modal"><i class="fa fa-camera style-fa"></i></a></em>
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
                        <form id="insert-image-form" action="./actions/store_class_image.php?id=<?php echo $rowsClass['class_id']; ?>"  method="post" runat="server" enctype="multipart/form-data">
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

    <div class="classuis comment_show">
        <div class="comment-content">
            <form action="#" method="post">
                <textarea placeholder="Say something to share with your class...." id="comments_textarea" name="comments_textarea" oninput='this.style.height = "";this.style.height = this.scrollHeight + 3 +  "px"' cols="138"></textarea>
                <input id="post_btn_comment" value="Post" type="submit">
            </form>
            <input id="file_btn_comment" type="file" name="file_btn_comment" multiple="multiple" onchange="uploadOnChange()">
            <input id="cancel_btn_comment" value="Cancel" type="submit" onclick="showClassComment()">
            <div id="display_file_comment"></div>
        </div>
    </div>


    <!--====== END POST CREATE ========================================-->

    <!--====== POST ========================================-->
    <div class="classuis">
        <div class="post">
            <!--====== POST CREATOR ========================================-->
                <!-- Nay bao gom ho ten, avatar cua nguoi post bai viet -->
            <div class="nav-link p-l-26" aria-haspopup="true" aria-expanded="false">
                <?php
                $initials = new Initials();
                $generateName = $initials->generate($_SESSION['fullname']);
                echo "<div class='post_user_name'>Nguyen Van A</div>";
                echo "<div class='circle circle-avt-comments'><div class='initials'>$generateName</div></div>"
                ?>
            </div>

            <!--====== POST CONTENTS ========================================-->
                <!-- Chứa nội dung, file của người đăng bài viết -->
            <div class="post_content">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <hr>

            <!--====== POST COMMENTS ========================================-->
                <!-- Chứa họ tên, avatar, nội dung comment ( không up file được ) của người comment bài post trên -->
            <div class="post_expand_comments">Click to see more comments....</div>
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
                $generateName = $initials->generate($_SESSION['fullname']);
                echo "<div class='circle circle-avt-comments avt_in_post'><div class='initials name_in_post'>$generateName</div></div>";
                echo "
                <form action='' method='post' class='form_post_comments'>
                    <div class='input_comments' contenteditable='true' data-text='Say something here....'></div>
                    <button class='post_comments_btn' type='submit'><i class='fa fa-paper-plane' aria-hidden=\"true\"></i></button>
                </form>
                ";
                ?>
            </div>

            <!--====== CREAT POST COMMENTS ========================================-->
        </div>
    </div>

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