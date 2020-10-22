<?php session_start();
if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}

require("Initials.php");
require ('actions/database.php');

$uid = $_GET['id'];
$query = "SELECT * FROM users WHERE user_id = '$uid'" ;
$result = mysqli_query($db,$query);
$rows = mysqli_fetch_assoc($result);

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
    <link rel="stylesheet" type="text/css" href="./css/login_main.css">
    <link rel="stylesheet" type="text/css" href="./css/util.css">
    <!--===============================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic">
                <img src="./css/images/img-01.png" alt="IMG"><br><br><br>
                <div class="alertLogin" ></div>
            </div>

            <!--=================================================================================================================-->
            <!--=================================================================================================================-->

            <!-- REGISTER FORM -->
            <form class="login100-form validate-form" method="post" action="./actions/role_validation.php">
					<span class="login100-form-title">
						User Profile
					</span>
                <br>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- UID-->
                <div class="wrap-input100">
                    <?php
                    echo "<input class=\"input100\" type=\"text\" name=\"uid\" readonly value='".$uid."'>";
                    ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- FULLNAME-->
                <div class="wrap-input100">
                    <?php
                    echo "<input class=\"input100\" type=\"text\" readonly value='".$rows['fullName']."'>";
                    ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- EMAIL -->
                <div class="wrap-input100">
                    <?php
                    echo "<input class=\"input100\" type=\"email\" readonly value='".$rows['email']."'>";
                    ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- PHONE NUMBER -->
                <div class="wrap-input100">
                    <?php
                    echo "<input class=\"input100\" type=\"number\" readonly value='".$rows['phoneNum']."'>";
                    ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
                </div>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- Date of Birth -->
                <div class="wrap-input100">
                    <?php
                    echo "<input class=\"input100\" type=\"date\" readonly value='".$rows['dateOfBirth']."'>";
                    ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-calendar" aria-hidden="true"></i>
						</span>
                </div>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- Role -->
                <div class="wrap-input100">

                    <?php
                    if($rows['role'] == "tea"){
                        if(isset($_SESSION['role'])){
                            if($_SESSION['role'] == "adm"){
                                echo "<select name=\"role-edit\" class=\"input100\">
                        <option value=\"Teacher\">Teacher</option>
                        <option value=\"Student\">Student</option>
                    </select>";
                            }else{
                                echo "<input class=\"input100\" type=\"text\"  readonly value='Teacher'>";
                            }
                        }
                    }elseif($rows['role'] == "stu"){
                        if(isset($_SESSION['role'])){
                            if($_SESSION['role'] == "adm"){
                                echo "<select name=\"role-edit\" class=\"input100\">
                        <option value=\"Teacher\">Teacher</option>
                        <option value=\"Student\">Student</option>
                    </select>";
                            }else{
                                echo "<input class=\"input100\" type=\"text\"  readonly value='Student'>";
                            }
                        }
                    }elseif($rows['role'] == "adm"){
                        if(isset($_SESSION['role'])){
                            if($_SESSION['role'] == "adm"){
                                echo "<input class=\"input100\" type=\"text\"  readonly value='Admin'>";
                            }
                        }
                    }
                    ?>

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-calendar" aria-hidden="true"></i>
						</span>
                </div>
                <br>

                <!--=================================================================================================================-->
                <!--=============================================== SAVE BUTTON =====================================================-->

                <button class="login100-form-btn" name="save-btn-submit" type="submit" >
                    Save
                </button>
                <br>
            </form>
            <button class="back-btn" onclick="window.location.href='manage.php'">Back</button>
        </div>
    </div>
</div>




</body>
<footer>
    <script src="./js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</footer>
</html>