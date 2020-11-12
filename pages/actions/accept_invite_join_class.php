<?php

// =================================================== ACCEPT INVITE JOIN CLASSROOM ==================================================
// =====================================================================================================================
// This action is for the student to accept invititation from the teacher to join classroom


require ("database.php");
session_start();

// =====================================================================================================================

// ================================================== ACTION PARTS =====================================================

$classID = $_GET['class_id'];
$stu_email = $_GET['stu_email'];
// Check if student are already exist in class or not
if(isset($classID) && !empty($classID)){
    //Get the Student ID
    $getStudentID = "SELECT user_id FROM users WHERE email='$stu_email'";
    $queryGetID = mysqli_query($db,$getStudentID);
    $resultID  = mysqli_fetch_assoc($queryGetID);

    $studentID = $resultID['user_id'];

    //Check if the student is already in class or not
    $checkStudent = "SELECT user_id FROM users_class WHERE user_id = '$studentID' AND class_id = '$classID'";
    $queryCheck = mysqli_query($db,$checkStudent);
    $resultCheck = mysqli_fetch_assoc($queryCheck);

    if($resultCheck > 0){
        header("Location: ../home.php");
    }else{

        // Dont have user_id then insert
        $insert_student = "INSERT INTO users_class VALUES ('$classID','$studentID')";
        echo $insert_student;
        mysqli_query($db,$insert_student);
        header("Location: ../home.php");
    }
}
else{
    //Invalid approach
}

