<?php
    require('database.php');
    session_start();

    //CREATE POST
    if(isset($_POST['post_btn_create'])){
            $classid = $_GET['class_id'];

            //GET FILE
            //filter empty string
            $file = array_filter($_FILES['file_input']['name']);
            //Count # of files in array
            $fileTotal = count($_FILES['file_input']['name']);

            $postContent = mysqli_real_escape_string($db, $_POST["comments_textarea"]);
            //Insert query
            $stmt_crt = $db->prepare("INSERT INTO post(user_id,content,class_id) VALUES(?,?,?)");
            $userID = $_SESSION['uid'];
            $stmt_crt->bind_param("sss",$userID,$postContent,$classid);

            //check if database error
            if  (($stmt_crt->execute()) === TRUE){
                $_SESSION["dbAddedSuccess"]= true;

                //GET the latest post_id
                $postSelectQuery="SELECT post_id FROM post ORDER BY post_id desc LIMIT 1";
                $postSelectQueryExec = mysqli_query($db,$postSelectQuery);
                $postSelectQueryResult = mysqli_fetch_assoc($postSelectQueryExec);

                //Create direction to holder folder
                $postDirPath = "../uploads/". $postSelectQueryResult['post_id']."/";
                //create folder to hold file
                mkdir($postDirPath,0777);
                //Loop to get each file
                for( $i=0; $i < $fileTotal; $i++){

                //Get temp file path
                $tmpFilePath = $_FILES['file_input']['tmp_name'][$i];

                if($tmpFilePath != ""){
                    $filePath = $postDirPath . $_FILES['file_input']['name'][$i];
                    move_uploaded_file($tmpFilePath,$filePath);
                }
            }
                //Upload file path to database
                $uploadFile = $db->prepare("UPDATE post SET file_dir = ? WHERE post_id = ?");
                $uploadFile->bind_param("ss",$postDirPath,$postSelectQueryResult['post_id']);
                if(($uploadFile->execute()) === TRUE){
                    header("Location: ../classroom_stream.php?class_id=$classid");
                } else {
                    echo $uploadFile->error;
                }
                } else {   
                echo $stmt_crt->error;  
                }
                $stmt_crt->close();
                $db->close();
    }
    //DELETE POST
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

    //UPDATE POST
    if(isset($_POST['update_post_btn'])){
            $classid = $_GET['class_id'];
            $post_id = $_GET['post_id'];
            //Update query
            $contentUpdate = mysqli_real_escape_string($db, $_POST["post_content_update"]);
            $stmt_upd = $db->prepare("UPDATE post SET content = ?  WHERE post_id = ?");
            //another way to set current time: SET dateT_update = now();
            $stmt_upd->bind_param("ss", $contentUpdate,$post_id);

            //GET FILE
                //filter empty string
                $file = array_filter($_FILES['file_input']['name']);
                //Count # of files in array
                $fileTotal = count($_FILES['file_input']['name']);

                $getPathQuery ="SELECT file_dir FROM post WHERE post_id = $post_id";
                //$getPathQuery->bind_param("s",$post_id);
                $getPathQueryExec = mysqli_query($db,$getPathQuery);
                $postDirPath = mysqli_fetch_assoc($getPathQueryExec);

                for( $i=0; $i < $fileTotal; $i++){

                    //Get temp file path
                    $tmpFilePath = $_FILES['file_input']['tmp_name'][$i];
    
                    if($tmpFilePath != ""){
                        $filePath = $postDirPath['file_dir'] . $_FILES['file_input']['name'][$i];
                        move_uploaded_file($tmpFilePath,$filePath);
                    }
                }

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