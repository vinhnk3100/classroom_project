<?php
// Form for recovery password, action will be pass to recovery_password.php
session_start();

if (isset($_SESSION['valid'])){
    if($_SESSION['valid'] != 1){
        header("Location: /myownclassroom/pages/forgot_password.php");
    }
}else {
    header("Location: /myownclassroom/pages/forgot_password.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--=================================== nathb@it.tdt.edu.vn ============================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/login_main.css">
    <link rel="stylesheet" type="text/css" href="./css/util.css">
    <!--===============================================================================================-->
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
            <form name="form-password-recovery" class="login100-form validate-form" method="post" action="./actions/recovery_password.php">
					<span class="login100-form-title">
						Forgot Password
					</span>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- ENTER CODE FROM EMAIL -->
                <div class="wrap-input100">
                    <input class="input100" type="text" name="code-generate-password-change" placeholder="Enter code here" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <hr>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- ENTER NEW PASSWORD -->
                <div class="wrap-input100">
                    <input class="input100" type="password" name="users-new-password" placeholder="Password" id="password-register" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <progress id="progress" value="0" max="100"></progress>
                <br>
                <span id="progresslabel"></span>
                <br>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- NEW PASSWORD CONFIRM -->
                <div class="wrap-input100">
                    <input class="input100" type="password" name="users-new-password-confirm" id="confirm-password-register" placeholder="Confirm Password" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <input type="button" id="submit-button" class="login100-form-btn" name="recovery-password-btn-submit" onclick="validate()" value="Change password">
                </div>
                <br>
                <div id="passwordChangeMsg" class="alertLogin"></div>
                    <?php
                    if(isset($_SESSION['recoveryMsg'])){
                        if($_SESSION['recoveryMsg'] == 0){
                            echo "<div>Failed to change password !</div>";
                        }elseif ($_SESSION['recoveryMsg'] == 2){
                            echo "<div class='alertLogin'>Password must be same !</div>";
                        }elseif ($_SESSION['recoveryMsg'] == 3){
                            echo "<div class='alertLogin'>Wrong code generate !</div>";

                        }unset($_SESSION['recoveryMsg']);
                    }
                    ?>
            </form>
        </div>
    </div>
</div>


</body>
<footer>
    <script src="./js/main.js"></script>
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