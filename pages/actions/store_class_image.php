<?php 
require ('database.php');


if(isset($_POST['btn_upload_class_image'])){
    
    
    // Get file info 
    $fileName = $_FILES["classImg"]["name"]; 
    $tempName = $_FILES["classImg"]["tmp_name"];
    $folder = "../css/backgroundImages/".$fileName;

    //Insert query
    $stmt = $db->prepare("UPDATE class SET classAvatar = ? WHERE class_id =?");
    $classid = $_GET['id'];
    $stmt->bind_param("ss", $fileName,$classid);
    

    //check if database error
    if (($stmt->execute()) === TRUE) {
        $_SESSION["dbAddedSuccess"]= true;
        // Move the uploaded image into folder 
        if (move_uploaded_file($tempName,$folder)){
            
            header("Location: ../classroom_stream.php?id=$classid");
        } else {
            die ("Failed to move image to".$folder);
        }
          
        } else {   
          echo $stmt->error;  
        }
    $stmt->close();
    $db->close();
    
}


?>