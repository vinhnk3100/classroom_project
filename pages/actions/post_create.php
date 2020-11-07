<?php
    require('database.php');
    session_start();

    if(isset($_POST['btn_post'])){
            $postContent = mysqli_real_escape_string($db, $_POST["comment_area"]);
            
    
            //Insert query
            $stmt = $db->prepare("INSERT INTO post(user_id, content, dateCurr, dateUp) VALUES(?,?,?,?)");
            $userID = $_SESSION['uid'];
            $stmt->bind_param("ssss",$userID ,$postContent,now(),null);

            //check if database error
            if (($stmt->execute()) === TRUE) {
                $_SESSION["dbAddedSuccess"]= true;
                
                header("Location: ../classroom_stream.php");
                
                } else {   
                echo $stmt->error;  
                }
                $stmt->close();
                $db->close();
    } 






?>