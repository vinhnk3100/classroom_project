<?php

// Forgotting password form, action sendmail with return_password.php
include ('actions/return_password.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--=================================================================================================================-->
    <!--=================================================================================================================-->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/login_main.css">
    <link rel="stylesheet" type="text/css" href="./css/util.css">

    <!--=================================================================================================================-->
    <!--=================================================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic">
                <img src="./css/images/img-01.png" alt="IMG">
            </div>

            <!--=================================================================================================================-->
            <!--=================================================================================================================-->

            <!-- PASSWORD FORM -->
            <form class="login100-form validate-form" method="post" action="/myownclassroom/pages/actions/return_password.php" onsubmit="return password">
					<span class="login100-form-title">
						Forgot Password
					</span>

                <!-- EMAIL -->
                <div class="wrap-input100">
                    <input class="input100" type="email" name="forgot-password-email" placeholder="Email" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" name="forgot-btn-submit" type="submit">
                        Send mail
                    </button>
                </div>

                <?php
                if(isset($_SESSION['forgot_password_msg'])){
                    if($_SESSION['forgot_password_msg'] == 0){
                        echo "<div class='alertLogin'>Mail has been sent, please check your inbox !</div>";
                        unset($_SESSION['forgot_password_msg']);
                        // Unset to stop alert session, start get valid
                        $_SESSION['valid'] = 1;
                    }elseif ($_SESSION['forgot_password_msg'] == 1){
                        echo "<div class='alertLogin'>This email does not exist !</div>";
                        session_unset();
                    }
                }

                if(isset($_SESSION['recoveryMsg'])){
                    if($_SESSION['recoveryMsg'] == 1){
                        echo "<div  class='alertLogin'>Password change successfully !</div>";
                        session_unset();
                    }
                }
                ?>
                <br>
            </form>

            <button class="back-btn" onclick="window.location.href='login_form.php'">Back to Login</button>


        </div>
    </div>
</div>


</body>
<footer>
    <script src="./js/login_main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</footer>
</html>