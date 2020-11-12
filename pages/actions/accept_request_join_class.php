<?php

// =================================================== ACCEPT REQUEST JOIN CLASSROOM ==================================================
// =====================================================================================================================
// Change classroom name, room, subject


require ("database.php");
session_start();


//=========================================== PREVENTING CROSS-SITE ATTACK =============================================

require ("../function/prevent_cross.php");

// =====================================================================================================================

// ================================================== ACTION PARTS =====================================================

$studentID =$_GET['id'];
if(isset($_GET['$studentID']) && !empty($_GET['$studentID'])){
    //Verify user_id    
    $check_user = "SELECT user_id FROM users WHERE user_id='$studentID'"; 
    $match  = mysqli_num_rows($check_user);
    echo $match;
}
else{
    //Invalid approach
}
if($match = 0){
    // Dont have user_id then insert
    $insert_student = "INSERT INTO users_class WHERE user_id = '$student_user'";
    echo '<div ">Your student have been added to your class. Go to class to check!</div>';
}else{
    // No match -> invalid url or account has already been activated.
    echo '<div ">The student is either invalid or you already have added your student.</div>';
}
