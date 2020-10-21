<?php
    // recovery_password action for password_recovery

require ('database.php');

    // =================================================================================================================
    // =================================================================================================================
    //===================================== IF RECOVERY PASSWORD BUTTON IS CLICKED =====================================
        session_start();

    // =================================================================================================================
    // =================================================================================================================
    //===================================== GET VALUE FROM INPUT FORM TO COMPARE WITH DATABASE =========================
        $newpassword = mysqli_real_escape_string($db, $_POST['users-new-password']);
        $confirmPwd = $_POST['users-new-password-confirm'];
        // Get value from input and session
        $pwdcode = $_POST['code-generate-password-change'];
        $email = $_SESSION['useremail'];

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db,$query);
        $rows = mysqli_fetch_assoc($result);

        // =================================================================================================================
        // =================================================================================================================
        // CHECK WHETHER THE SESSION CODE IS GENERATE OR NOT
        if(isset($_SESSION['generatePwdCode'])){

            // =================================================================================================================
            // =================================================================================================================
            // Check if the input code is equal to the generate code from email
            if($pwdcode == $_SESSION['generatePwdCode']){
                if(mysqli_num_rows($result) == 1){
                    mysqli_query($db,"UPDATE users set passWord = '$newpassword' WHERE email = '$email'");
                    session_unset();
                    header("Location: /myownclassroom/pages/forgot_password.php");
                    $_SESSION['recoveryMsg'] = 1;
                }
            }else{
                $_SESSION['recoveryMsg'] = 3;
                header("Location: /myownclassroom/pages/password_recovery.php");
            }
        }
?>