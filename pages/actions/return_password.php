<?php
    // This action send link to email to get to access into page password_recovery.php

    $headers = 'From: eclassroom.me@gmail.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .

        'Content-Type: text/html; charset=utf-8';

    //===================================== Connect to Database =====================================
    require ('database.php');

    //===================================== If login button is clicked =====================================
    if(isset($_POST['forgot-btn-submit'])){

        //===================================== Get value from form to compare with database =====================================
        $useremail = mysqli_real_escape_string($db, $_POST['forgot-password-email']);


        $query = "SELECT * FROM users WHERE email = '$useremail'";
        $result = mysqli_query($db,$query);
        $rows = mysqli_fetch_assoc($result);
        $randomCode = uniqid('pwd');
        if(mysqli_num_rows($result) == 1){
            session_start();
            $_SESSION['useremail'] = $useremail;
            $_SESSION['forgot_password_msg'] = 0;
            $result = mail($useremail,"Return password","<a href='http://localhost/myownclassroom/pages/password_recovery.php'>Click here to recover your password</a> Code : $randomCode",$headers);
            $_SESSION['generatePwdCode'] = $randomCode;
            header("Location: /myownclassroom/pages/forgot_password.php");
        }else {
            session_start();
            $_SESSION['forgot_password_msg'] = 1;
            header("Location: /myownclassroom/pages/forgot_password.php");
        }
    }

?>