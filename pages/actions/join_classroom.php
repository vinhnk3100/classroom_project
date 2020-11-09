<?php
session_start();
require ('database.php');
    // This action send link to email to get to access into page password_recovery.php
    $user_email = $_SESSION['useremail'];
    $headers = 'From: '.$user_email. "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-Type: text/html; charset=utf-8';

    //connect database
    

    if  (isset($_POST['btn_join_class'])){
        // receive values from the form
        $class_id  = mysqli_real_escape_string($db, $_POST["classroom-code"]);
        // take values from database
        $query = "SELECT class_id FROM class WHERE class_id = '$class_id'";
        $result= mysqli_query($db, $query);
        if(isset($result))
        {
            $teacher_email = "SELECT email FROM users  
            WHERE user_id in(SELECT teacher_id from class WHERE class_id='$class_id'";
            mail($teacher_email,"Accept Request","<a href='http://localhost/myownclassroom/pages/password_recovery.php'>Click here to recover your password</a> Code :",$headers);
        }else{
            header("Location: ../register.php");
        }
    }
?>