<?php session_start();
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
    <link rel="stylesheet" type="text/css" href="./css/register_effect.css">
    <link rel="stylesheet" type="text/css" href="./css/login_main.css">
    <!--===============================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic">
                <img src="./css/images/img-01.png" alt="IMG">
            </div>


            

            <!-- REGISTER FORM -->
            <form class="login100-form validate-form" method="post" action="./actions/register_validation.php" id="registerForm" name = "registerForm">
					<span class="login100-form-title">
						Register
					</span>




                <!-- FULLNAME-->

                <!-- php codes to set class to wrap-input100 error to enable the visibility of small tag-->
                <div class="<?php
                                if(isset($_SESSION["existErrorFullName"])){
                                    echo "wrap-input100.error";
                                }
                                else{
                                    echo "wrap-input100";
                                }
                            ?>">
                    <input class="input100" type="text" id="users-fullname-register" name="users-fullname-register" placeholder="Fullname">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small >
                        <?php 
                            if(isset($_SESSION["existErrorFullName"])){
                                echo "<small class=\"alertLogin\">Username is already exist</small>";
                                unset($_SESSION["existErrorFullName"]);
                            } 
                    ?>
                    </small>
                    <span class="symbol-input100">
							<i class="fa fa-user fa-margin" aria-hidden="true"></i>
						</span>
                </div>

                <!-- EMAIL -->

                <!-- php codes to set class to wrap-input100 error to enable the visibility of small tag-->
                <div class="<?php
                                if(isset($_SESSION["existErrorEmail"])){
                                    echo "wrap-input100.error";
                                }
                                else{
                                    echo "wrap-input100";
                                }
                            ?>">
                    <input class="input100" type="email" id="users-email-register" name="users-email-register" placeholder="Email">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small >
                        <?php 
                            if(isset($_SESSION["existErrorEmail"])){
                                echo "<small class=\"alertLogin\">Email is already exist</small>";
                            
                                unset($_SESSION["existErrorEmail"]);
                            } 
                    ?>
                    </small>
                    
                    <span class="symbol-input100">
							<i class="fa fa-envelope fa-margin" aria-hidden="true"></i>
						</span>
                </div>

                <!-- PHONE NUMBER -->
                <div class="wrap-input100">
                    <input class="input100" type="number" id="users-phone-register" name="users-phone-register" placeholder="Phone number" >
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error</small>
                    
                    <span class="symbol-input100">
							<i class="fa fa-phone fa-margin" aria-hidden="true"></i>
						</span>
                </div>

                <!-- Date of Birth -->
                <div class="wrap-input100">
                    <input class="input100" type="date" id="users-dob-register" name="users-dob-register" placeholder="Date of birth" >
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error</small>
                    
                    <span class="symbol-input100">
							<i class="fa fa-calendar fa-margin" aria-hidden="true"></i>
						</span>
                </div>


                <!-- PASSWORD -->
                <div class="wrap-input100">
                    <input class="input100" type="password" id="users-password-register" name="users-password-register" placeholder="Password" >
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error</small>
                    
                    <span class="symbol-input100">
							<i class="fa fa-lock fa-margin" aria-hidden="true"></i>
                    </span>
                </div>
                <progress id="progress" value="0" max="100"></progress>
                <br>
                <span id="progresslabel"></span>
                <br>

                <!-- PASSWORD CONFIRM -->
                <div class="wrap-input100">
                    <input class="input100" type="password" id="users-password-confirm-register" name="users-password-confirm-register" placeholder="Confirm Password" >
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error</small>
                    
                    <span class="symbol-input100">
							<i class="fa fa-lock fa-margin" aria-hidden="true"></i>
						</span>
                </div>
                
                
                <!-- SIGNUP BUTTON -->
                <div class="container-login100-form-btn">

                    <!--Use a hidden input(type hidden) to accept the name when pass to php (In case of using input(type button) ) -->
                    <input type="hidden" name="register-btn-submit"> 

                    <!-- SIGNUP BUTTON -->
                    <!-- Input type button only used to execute the function in onclick, neither to submit the form nor take any attribute -->
                     <input class="login100-form-btn"  type="button" onclick="registerCheck()" value="Sign Up"> 
                   <!--  <button class="login100-form-btn" name="register-btn-submit" >SIGN UP</button> -->



                </div>
                <br>
            </form>
            <button class="back-btn" onclick="window.location.href='login_form.php'">Back to Login</button>
        </div>
    </div>
</div>




</body>
<footer>
    <script src="./js/register_main.js"></script>
    <script src="./js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</footer>
</html>