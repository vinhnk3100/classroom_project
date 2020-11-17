<?php
session_start();

if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}else{
    require('actions/database.php');
    require("Initials.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Classroom</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/card-classroom.css">

    <link rel="stylesheet" type="text/css" href="./css/util.css">
    <link rel="stylesheet" type="text/css" href="./css/modal-form.css">
</head>

<body>
<main>
        <!--====== NAVBAR TOP =======================-->
    <?php include ("./function/nav-bar-action-home.php")?>


    <!--====== NAVBAR TOP =======================-->

    <br>

    <!--=================================================================================================================-->
    <!--=================================================================================================================-->

    <!-- ====================================== START CARD LIST VIEW ======================================-->
    <div class="container">
        <div class="row card-padding-top">
            <?php

            $uid = $_SESSION['uid'];

            // ===============================================================================================================
            // ================================== IF LOGIN AS ADMIN, SHOW ALL CLASSROOM ======================================

            include ('function/queryAdminClassroom.php');

            // ===============================================================================================================
            // =========================== IF LOGIN AS STUDENT, SHOW CLASSROOM STUDENT JOIN ==================================

            include ('function/queryStudentClassroom.php');

            // ===============================================================================================================
            // =========================== IF LOGIN AS TEACHER, SHOW CLASSROOM TEACHER JOIN ==================================

            include ('function/queryTeacherClassroom.php');

            if(isset($_POST['class_search_btn'])){
                include ("./pages/actions/class_search.php");
            }


            ?>
        </div>

        <?php // SHOW ERROR IF PASSWORD IS INCORRECT
        if(isset($_SESSION['errorsPassword'])){
            if($_SESSION['errorsPassword'] == 1){
                echo "<div class='alertLogin'>Wrong username or password</div>".$_SESSION['result'];
                session_unset();
            }
        }

        if(isset($_SESSION['valid_classroom'])){
            if($_SESSION['valid_classroom'] != 1){
                $message = "Class id does not exist !";
                echo "<script type='text/javascript'>alert('$message');</script>";
                unset($_SESSION['valid_classroom']);
            }
        }elseif (isset($_SESSION['valid_studentID'])){
            if($_SESSION['valid_studentID'] != 1){
                $message = "The Student ID is invalid Or already existed in class !";
                echo "<script type='text/javascript'>alert('$message');</script>";
                unset($_SESSION['valid_studentID']);
            }else{
                $message = "Accept Student join class success !";
                echo "<script type='text/javascript'>alert('$message');</script>";
                unset($_SESSION['valid_studentID']);
            }
        }
        ?>
    </div>

    <!-- ====================================== END CARD LIST VIEW ======================================-->


</main>

<footer>
    <script src="./js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

</footer>
</body>
</html>