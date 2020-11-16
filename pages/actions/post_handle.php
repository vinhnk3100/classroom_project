<?php
    require('database.php');
    session_start();


    if(isset($_POST['post_btn_create'])){
            $postContent = mysqli_real_escape_string($db, $_POST["comments_textarea"]);
            //Insert query
            $stmt = $db->prepare("INSERT INTO post(user_id,content,class_id) VALUES(?,?,?)");
            $classid = $_GET['class_id'];
            $userID = $_SESSION['uid'];
            $stmt->bind_param("sss",$userID,$postContent,$classid);

            //check if database error
            if  (($stmt->execute()) === TRUE){
                $_SESSION["dbAddedSuccess"]= true;
                header("Location: ../classroom_stream.php?class_id=$classid");
                } else {   
                echo $stmt->error;  
                }
                $stmt->close();
                $db->close();
    }

  /*  if(isset($_POST['btn_delete'])){
        
            //Delete query
            $deletePost = "DELETE FROM post WHERE post_id = document.getElementById("")"
    }

    if(isset($_POST['btn_update'])){

            //Update query
            $contentUpdate = mysqli_real_escape_string($db, $_POST["comment_update"]);
            $updatePost = $db->prepare("UPDATE post SET content = ?, dateT_update = ? WHERE post_id = ?");
            $dateTUpdate = date('d/m/Y h:i:s ', time());
            $updatePost->bind_param("sss", $contentUpdate,$dateTUpdate,$);
    }*/
?>