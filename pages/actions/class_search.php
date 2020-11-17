<?php

require ("database.php");

if(isset($_POST["class_search_btn"])) {
    session_start();
    $classID = mysqli_real_escape_string($db, $_POST["class_search_bar"]);
    $userID = $_SESSION['uid'];

    // Search Query
    $querySearch = "SELECT * from users_class WHERE class_id = '$classID' and user_id = '$userID'";
    $resultSearch = mysqli_query($db, $querySearch);

    if(mysqli_num_rows($resultSearch) == 1){
        header("Location: /myownclassroom/pages/classroom_stream.php?class_id=$classID");
    }else{
        header("Location: /myownclassroom/pages/home.php");
    }




}

