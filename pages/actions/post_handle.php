<?php
    require('database.php');
    session_start();
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    if(isset($_POST['btn_post'])){
            $postContent = mysqli_real_escape_string($db, $_POST["comment_area"]);
            
    
            //Insert query
            $stmt = $db->prepare("INSERT INTO post(user_id, content, dateT_current) VALUES(?,?,?)");
            $userID = $_SESSION['uid'];
            $classid = $_GET['id'];
            $dateTime=date('d/m/Y h:i:s ', time());
            $stmt->bind_param("sss",$userID ,$postContent,$dateTime);

            //check if database error
            if  (($stmt->execute()) === TRUE){
                $_SESSION["dbAddedSuccess"]= true;
                
                header("Location: ../classroom_stream.php?id=$classid");
                } else {   
                echo $stmt->error;  
                }
                $stmt->close();
                $db->close();
    }

    if(isset($_POST['btn_delete'])){
        
            //Delete query
            $deletePost = "DELETE FROM post WHERE post_id = document.getElementById("")"
    }

    if(isset($_POST['btn_update'])){

            //Update query
            $contentUpdate = mysqli_real_escape_string($db, $_POST["comment_update"]);
            $updatePost = $db->prepare("UPDATE post SET content = ?, dateT_update = ? WHERE post_id = ?");
            $dateTUpdate = date('d/m/Y h:i:s ', time());
            $updatePost->bind_param("sss", $contentUpdate,$dateTUpdate,$);
    }
?>