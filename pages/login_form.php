<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/util.css">
    <link rel="stylesheet" type="text/css" href="./css/login_main.css">
    <!--===============================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="./css/images/img-01.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" method="post" action="./actions/login_validation.php">
					<span class="login100-form-title">
						Classroom
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="users-email-login" placeholder="Email" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="users-password-login" placeholder="Password" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" name="login-btn-submit"style="">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <a class="txt2" href="forgot_password.php">
                        Forgot Password ?
                    </a>
                </div>



                <div class="dbAddedSuccess">
                <p class="dbAddedSuccess">
                <?php
                if(isset($_SESSION["dbAddedSuccess"])){
                    echo "<div class=\"alertLogin\">Your account has been created!</div>";
                    unset($_SESSION["dbAddedSuccess"]); 
                }
                ?>
                </p>
                 </div>





                <?php // SHOW ERROR IF PASSWORD IS INCORRECT
                    if(isset($_SESSION['errorsPassword'])){
                        if($_SESSION['errorsPassword'] == 1){
                            echo "<div class='alertLogin'>Wrong username or password</div>";
                            session_unset();
                        }
                    }
                ?>
                <div class="text-center p-t-136">
                    <a class="txt2" href="register.php">
                        Create your Account
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>


        </div>
    </div>
</div>




</body>
<footer>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</footer>
</html>