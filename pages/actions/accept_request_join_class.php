<?php

// =================================================== ACCEPT REQUEST JOIN CLASSROOM ==================================================
// =====================================================================================================================
// Change classroom name, room, subject


require ("database.php");
session_start();


//=========================================== PREVENTING STUDENT CROSSING INVITE ATTACK =============================================
require ("../function/prevent_cross.php");

// =====================================================================================================================

// ================================================== ACTION PARTS =====================================================

$studentID =$_GET['id'];
$classID = $_GET['class_id'];

// Check if student are already exist in class or not
if(isset($studentID) && !empty($studentID)){
    //Verify user_id
    $check_user = "SELECT user_id FROM users_class WHERE user_id='$studentID' AND class_id = '$classID'";
    $queryUser = mysqli_query($db,$check_user);
    $match  = mysqli_fetch_assoc($queryUser);

    if($match > 0){
        // No match -> invalid url or account has already been activated.
        $_SESSION['valid_studentID'] = 0;
    }else{
        // Dont have user_id then insert
        $insert_student = "INSERT INTO users_class VALUES ('$classID','$studentID')";
        mysqli_query($db,$insert_student);
        $_SESSION['valid_studentID'] = 1;
    }
}

