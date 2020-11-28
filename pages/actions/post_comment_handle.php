<?php 
//connect to database
require ('database.php');
session_start();

$classid = $_GET['class_id'];
/*
if(isset($_POST['post_comment_btn'])){
    $comment = mysqli_real_escape_string($db, $_POST['post_comment']);

    //Insert query
    $stmt_crt = $db->prepare("INSERT INTO comment(user_id,comment,post_id) VALUES(?,?,?");
    $userID = $_SESSION['uid'];
    $stmt_crt->bind_param("sss",$userID,$comment,$post_id);

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

}

if(isset($_POST['post_comment_delete_btn'])){
    $post_id = $_GET['post_id'];
    $stmt_dlt = $db->prepare("DELETE FROM comment WHERE c_id = $c_id");

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

if(isset($_POST['post_comment_update_btn'])){
    $post_id = $_GET['post_id'];

    //Update query
    $commentUpdate = mysqli_real_escape_string($db, $_POST["comment_update"]);
    $stmt_upd = $db->prepare("UPDATE comment SET comment = ?, dateT_update = ? WHERE post_id = ?");
    $dateTUpdate = date('d/m/Y h:i:s ', time()); 
    //another way to set current time: SET dateT_update = now();
    $stmt_upd->bind_param("sss", $contentUpdate,$dateTUpdate,$post_id);

    //check if database error
    if  (($stmt_upd->execute()) === TRUE){
        $_SESSION["dbAddedSuccess"]= true;
        $_SESSION["post_updated"]= true;
        header("Location: ../classroom_stream.php?class_id=$classid");
        } else {   
        echo $stmt_upd->error;  
        }
        $stmt_upd->close();
        $db->close();


}

?>
*/