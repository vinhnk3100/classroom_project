<?php
    require('database.php');
    session_start();


    if(isset($_POST['post_btn_create'])){
            $classid = $_GET['class_id'];

            $filename = $_FILES['file_input']['name'];
            $destination = '../uploads/' . $filename;

            $postContent = mysqli_real_escape_string($db, $_POST["comments_textarea"]);
            //Insert query
            $stmt_crt = $db->prepare("INSERT INTO post(user_id,content,class_id,file_dir) VALUES(?,?,?,?)");
            $userID = $_SESSION['uid'];
            $stmt_crt->bind_param("ssss",$userID,$postContent,$classid,$filename);

            //check if database error
            if  (($stmt_crt->execute()) === TRUE){
                $_SESSION["dbAddedSuccess"]= true;
                header("Location: ../classroom_stream.php?class_id=$classid");
                } else {   
                echo $stmt_crt->error;  
                }
                $stmt_crt->close();
                $db->close();
    }

    if(isset($_POST['delete_post_btn'])){
            $classid = $_GET['class_id'];
            $post_id = $_GET['post_id'];
            //Delete query
            $stmt_dlt = $db->prepare("DELETE FROM post WHERE post_id = '$post_id'");

            //check if database error
            if  (($stmt_dlt->execute()) === TRUE){
                $_SESSION["dbAddedSuccess"]= true;
                header("Location: ../classroom_stream.php?class_id=$classid");
                } else {
                echo $stmt_dlt->error;
                }
                $stmt_dlt->close();
                $db->close();
    }


    if(isset($_POST['update_post_btn'])){
            $classid = $_GET['class_id'];
            $post_id = $_GET['post_id'];
            //Update query
            $contentUpdate = mysqli_real_escape_string($db, $_POST["post_content_update"]);
            $stmt_upd = $db->prepare("UPDATE post SET content = ?  WHERE post_id = ?");
            //another way to set current time: SET dateT_update = now();
            $stmt_upd->bind_param("ss", $contentUpdate,$post_id);

            //check if database error
            if  (($stmt_upd->execute()) === TRUE){
                $_SESSION["dbAddedSuccess"]= true;
                header("Location: ../classroom_stream.php?class_id=$classid");
                } else {
                echo $stmt_upd->error;
                }
                $stmt_upd->close();
                $db->close();
    }
?>