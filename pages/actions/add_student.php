<?php

// ========================================== ADD STUDENT INTO CLASSROOM ===============================================
require ("database.php");
session_start();

//=========================================== PREVENTING CROSS-SITE ATTACK =============================================

include ("../function/prevent_cross.php");

// =====================================================================================================================

if(isset($_POST['btn_invite_class'])){

    // Get the values from form
    $student_email = mysqli_real_escape_string($db, $_POST["student_email_invite"]);

    // Query to compare class_id in url with Database
    $query = "SELECT className, subject, classRoom FROM class WHERE class_id = '$classid'";
    $result = mysqli_query($db, $result);
}



?>