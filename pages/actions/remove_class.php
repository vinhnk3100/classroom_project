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
// ============================================== ACTION REMOVE CLASS ==================================================


$classid = $_GET['id'];
require ('database.php');

    $query = "DELETE FROM class WHERE class_id = '$classid'";

    $remove_class = mysqli_query($db,$query);

    if(isset($remove_class)){
        header("Location: /myownclassroom/pages/home.php");
    }else{
        header("Location: /myownclassroom/pages/classroom_everyone.php?id=$classid");
    }


?>


