<?php
    // recovery_password action for password_recovery

require ('database.php');

    //===================================== If recovery button is clicked =====================================
        session_start();

        // For example, if your database has md5 encrypted password, then the query will be,
        //
        //mysql_query(“UPDATE users set password='” . md5($_POST[“newPassword”]) . “‘ WHERE userId='” . $_SESSION[“userId”] . “‘”);

        //===================================== Get value from form to compare with database =====================================
        $newpassword = mysqli_real_escape_string($db, $_POST['users-new-password']);
        $confirmPwd = $_POST['users-new-password-confirm'];
        // Get value from input and session
        $pwdcode = $_POST['code-generate-password-change'];
        $email = $_SESSION['useremail'];

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db,$query);
        $rows = mysqli_fetch_assoc($result);

        // Check if session code generate is set or not
        if(isset($_SESSION['generatePwdCode'])){
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