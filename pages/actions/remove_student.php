<?php

// =====================================================================================================================
// ============================================== PREVENTING CROSS SITE ATTACK =========================================

session_start();
if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}elseif ($_SESSION['role'] != "adm" || $_SESSION['role'] != "tea"){
    header("Location: /myownclassroom");
}


// =====================================================================================================================
// ============================================== ACTION REMOVE STUDENT FROM CLASS =====================================

$uid = $_GET['id'];
$classid = $_GET['class_id'];
require ('database.php');

    $query = "DELETE FROM users_class WHERE user_id = '$uid' AND class_id = '$classid'";

    mysqli_query($db,$query);

    header("Location: /myownclassroom/pages/classroom_everyone.php?class_id=$classid");
?>


