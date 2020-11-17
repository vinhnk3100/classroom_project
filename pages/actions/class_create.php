<?php

//connect database
require ('database.php');
session_start();


if (isset($_POST['btn_create_class'])){
// receive values from the form
     $className  = mysqli_real_escape_string($db, $_POST["create-classroom-name"]);
     $classSubject  = mysqli_real_escape_string($db, $_POST["create-classroom-subject"]);
     $classRoom  = mysqli_real_escape_string($db, $_POST["create-classroom-room"]);
     



    $stmt = $db->prepare("INSERT INTO class(class_id,className,subject,classRoom,teacher_id)
    VALUES(?, ?, ?, ?, ?)");

    $class_id = substr(uniqid(),0,8);
    $teacher_id = $_SESSION['uid'];

    $stmt->bind_param("sssss",$class_id,$className,$classSubject,$classRoom,$teacher_id);
    
                   
    //check if database error
    if (($stmt->execute()) === TRUE) {
    $_SESSION["dbAddedSuccess"]= true;
    
    header("Location: ../home.php");
      
    } else {   
      echo $stmt->error;  
    }
    $stmt->close();
    $db->close();
  } else header("Location: ../home.php"); 
   

?>