<?php

require ('database.php');
// =================================================================================================================
// =================================================================================================================
//===================================== IF LOGIN BUTTON IS CLICKED =================================================
if(isset($_POST['login-btn-submit'])){

    // =============================================================================================================
    // =============================================================================================================
    //===================================== GET VALUE FROM INPUT TO COMPARE WITH DATABASE ===========================
    $useremail = mysqli_real_escape_string($db, $_POST['users-email-login']);
    $userpassword = mysqli_real_escape_string($db, $_POST['users-password-login']);


    $query = "SELECT * FROM users WHERE email = '$useremail'";
    $querypwd = "SELECT passWord FROM users WHERE email = '$useremail'";

    $result = mysqli_query($db,$query);
    $resultpwd = mysqli_query($db,$querypwd);

    $rows = mysqli_fetch_assoc($result);

    $rowspwd = mysqli_fetch_assoc($resultpwd);

    // =================================================================================================================
    // =================================================================================================================
    // CREATE VARIABLE TO HASHED THE PASSWORD

    $hashed = $rowspwd['passWord'];


    if(mysqli_num_rows($result) == 1){

        // =================================================================================================================
        // =================================================================================================================
        // CHECK IF PASSWORD IS UNHASHED VERIFY
        if(password_verify($userpassword,$hashed)){
            session_start();
            $_SESSION['useremail'] = $useremail;
            $_SESSION['errorsPassword'] = 0;
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['fullname'] = $rows['fullName'];
            $_SESSION['uid'] = $rows['user_id'];
            $_SESSION['role'] = $rows['role'];
            header("Location: /myownclassroom/pages/home.php");
        }else {
            session_start();
            $_SESSION['errorsPassword'] = 1;
            $_SESSION['valid'] = false;
            header("Location: /myownclassroom/pages/login_form.php");
        }
    }else {
        session_start();
        $_SESSION['errorsPassword'] = 1;
        $_SESSION['valid'] = false;
        header("Location: /myownclassroom/pages/login_form.php");
    }
}else {
    header("Location: /myownclassroom/pages/login_form.php");
    session_unset();
}


?>
