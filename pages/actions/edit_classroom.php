<?php

// =================================================== EDIT CLASSROOM ==================================================
// =====================================================================================================================
// Change classroom name, room, subject

$classid = $_GET['class_id'];

require ("database.php");
session_start();

//=========================================== PREVENTING CROSS-SITE ATTACK =============================================

require ("../function/prevent_cross.php");

// =====================================================================================================================

if (isset($_POST['btn_edit_class'])){

// Get the value from edit classroom form
    $className  = mysqli_real_escape_string($db, $_POST["edit_classname"]);
    $classSubject  = mysqli_real_escape_string($db, $_POST["edit_class_subject"]);
    $classRoom  = mysqli_real_escape_string($db, $_POST["edit_class_room"]);

    // Query to compare class_id in url with Database
    $query = "SELECT className, subject, classRoom FROM class WHERE class_id = '$classid'";
    $result = mysqli_query($db, $result);

    // Check if that classroom is exist or not
    if(is_null($className) || is_null($classSubject) || is_null($classRoom)){
        header("Location: ../home.php");
    }else{
        if(isset($result)){
            mysqli_query($db,"UPDATE class set className = '$className', subject = '$classSubject', classRoom = '$classRoom' WHERE class_id = '$classid'");
            header("Location: ../home.php");
        }
    }


}


?>
