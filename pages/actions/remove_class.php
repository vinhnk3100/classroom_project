<?php

// =====================================================================================================================
// ============================================== ACTION REMOVE STUDENT FROM CLASS =====================================

$uid = $_GET['id'];
$classid = $_GET['class_id'];
require ('database.php');

$query = "DELETE FROM users_class WHERE user_id = '$uid'";

mysqli_query($db,$query);

header("Location: /myownclassroom/pages/home.php");
?>


