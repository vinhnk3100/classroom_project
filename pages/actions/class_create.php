<?php

+//connect database
require ('database.php');
session_start();


if (isset($_POST['btn_create_class'])){
// receive values from the form
     $className  = mysqli_real_escape_string($db, $_POST["create-classroom-name"]);
     $classSubject  = mysqli_real_escape_string($db, $_POST["create-classroom-subject"]);
     $classRoom  = mysqli_real_escape_string($db, $_POST["create-classroom-room"]);





//Check db for duplicate class name
$falseCheck = true;
/*$currentTeacher = $_SESSION['uid'];
$className_check_query = "SELECT className FROM class WHERE teacher_id='$currentTeacher' AND className = '$className' LIMIT 1";
$result = mysqli_query($db, $className_check_query);
$checkClass = mysqli_fetch_assoc($result);

if($checkClass){
    $_SESSION["existErrorClassName"] = true;
    $falseCheck = false;
    header("Location: /myownclassroom/pages/home.php");
}*/

if($falseCheck){
    $class_id = uniqid('cls');
    $teacher_id = $_SESSION['uid'];
    $insertQuery = "INSERT INTO class(class_id,className,subject,classRoom,teacher_id)
                    VALUES('$class_id','$className','$classSubject','$classRoom','$teacher_id')";

    

 //check if database error
 if ($db->query($insertQuery) === TRUE) {
    $_SESSION["dbAddedSuccess"]= true;
    header("Location: ../home.php");
      
    } else {
      echo "Error: " . $insertQuery . "<br>" . $db-> error;
      
    }
}
 
} else die ("fail!");

?>