<?php
session_start();
if(isset($_SESSION['fullname'])){
    if($_SESSION['fullname'] == null){
        header("Location: /myownclassroom");
    }
}
require('actions/database.php');
require("Initials.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Classroom</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/util.css">
    <link rel="stylesheet" type="text/css" href="./css/modal-form.css">
</head>

<body>
<main>
    <div>
        <!--====== NAVBAR TOP =======================-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="./css/images/icons8-classroom-80.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Classroom
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            // Check if admin, teacher, student
                            if (isset($_SESSION['role'])){
                                if($_SESSION['role'] == 'adm'){
                                    echo "<a href=\"#modal-create-classroom\" class=\"dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Create classroom</a>";
                                    echo "<a href=\"#modal-join-classroom\" class=\"dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Join classroom</a>";
                                    echo "<div class=\"dropdown-divider\"></div>
                                        <a class=\"dropdown-item\" href=\"manage.php\">Manage</a>";
                                }elseif ($_SESSION['role'] == 'tea'){
                                    echo "<a href=\"#modal-create-classroom\" class=\"dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Create classroom</a>";
                                }elseif ($_SESSION['role'] == 'stu'){
                                    echo "<a href=\"#modal-join-classroom\" class=\"dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Join classroom</a>";
                                }
                            }?>
                        </div>
                    </li>
                    <?php
                    // Check if admin, teacher, student
                    if (isset($_SESSION['role'])){
                        if($_SESSION['role'] == 'adm'){
                            echo "<a href=\"manage.php\" class=\"nav-link\" id=\"navbarDropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        Manage
                    </a>";
                        }
                    }?>
                </ul>
                <!--==============================================================================  ============-->

                <!-- Modal for CREATE CLASSROOM  -->

                <!-- Modal HTML -->
                <div id="modal-create-classroom" class="modal fade">
                    <div class="modal-dialog modal-login">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Create classroom</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <!--./actions/class_create.php-->
                                <form action="./actions/class_create.php" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="create-classroom-name" id="create-classroom-name" placeholder="Class name" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="create-classroom-subject" id="create-classroom-subject" placeholder="Subject" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="create-classroom-room" id="create-classroom-room" placeholder="Room" required="required">
                                    </div>
                                    <div class="form-group">
                                        <!-- <input type="hidden" name="btn_create_class"> -->
                                        <!-- <button class="btn btn-primary btn-block btn-lg">Create</button>-->
                                        <input type= "submit" class="btn btn-primary btn-block btn-lg" name = "btn_create_class" id="btn_create_class" value="Create">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for CREATE CLASSROOM  -->

                <!-- Modal for JOIN CLASSROOM  -->
                <div id="modal-join-classroom" class="modal fade">
                    <div class="modal-dialog modal-join-classroom">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">You're Login as <?php echo $_SESSION['fullname'];?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action=" " method="post">
                                    <label>Enter classroom code : </label>
                                    <div class="form-group">
                                        <i class="fa fa-book"></i>
                                        <input type="text" class="form-control" name="classroom-code" placeholder="Classroom Code" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Join">
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <p>Ask your teacher for the class code and enter it here.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ======= CHECK IF USER LOGGED IN OR NOT ========= -->


                <!-- END Modal for JOIN CLASSROOM  -->

                <!-- BUTTON LOGOUT - AVATAR ACCOUNT INFORMATION -->

                <ul class="navbar-nav margin-dropdown">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            $initials = new Initials();
                            $generateName = $initials->generate($_SESSION['fullname']);
                            echo "<div class='circle'><div class='initials'>$generateName</div></div>"
                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="navbarDropdown">
                            <?php
                            echo "<div class=\"circle m-l-r-auto\"><a href=\"#\" class=\"initials text-align-profile\" >".$generateName."</a></div><br>";
                            echo "<div class=\"text-center\"><a href=\"#\" class=\"text-align-profile\" >".$_SESSION['fullname']."</a></div>";
                            ?>
                            <?php
                            echo "<div class=\"text-center\"><a href=\"#\" class=\"btn btn-outline-success my-2 my-sm-0 nav-link\" >".$_SESSION['useremail']."</a></div>";
                            ?>
                            <div class="dropdown-divider"></div>
                            <div class="text-center margin-dropdown"><a href="./actions/logout.php" class="btn btn-outline-success my-2 my-sm-0" >Logout</a></div>
                        </div>
                    </li>
                </ul>
             </div>
    </div>
    </nav>
    </div>


    <!--====== NAVBAR TOP =======================-->

    <br><br><br>

    <!-- ====================================== Card List View ======================================-->
    <div class="container container-background">
        <div class="row">
            <?php

            $uid = $_SESSION['uid'];

            // Query for showing class through Session ID
            $queryUID = "SELECT * FROM class,users WHERE  class.teacher_id = users.user_id AND class.teacher_id = '$uid'";

            // Query for showing all the class for administrator
            $queryClassAdmin = "SELECT * FROM class,users WHERE class.teacher_id = users.user_id";

            // Query for showing class creator
            $queryCreator = "SELECT * FROM users, class WHERE users.user_id = class.teacher_id AND class.teacher_id = '$uid' ";

            $resultUID = mysqli_query($db,$queryUID);
            $resultCreator = mysqli_query($db,$queryCreator);
            $resultClassAdmin = mysqli_query($db,$queryClassAdmin);


            if (mysqli_num_rows($resultUID) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($resultUID)) {

                    // If session login is teacher
                    if($_SESSION['role'] == 'tea'){
                        while($rowCreator = mysqli_fetch_assoc($resultCreator)) {
                            $classid = $rowCreator['class_id'];
                            $classteacherName= $rowCreator['fullName'];
                            $classavatar = $rowCreator['classAvatar'];
                            $classname = $rowCreator['className'];
                            $_POST['classname'] = $classname;
                            echo "<div class=\"col-3 margin_bottom_card\" draggable='true'>
                    <div class=\"m-3\">
                        <div class=\"card\">
                            <img class=\" card-size\" src='$classavatar' alt=''>
                            <div class=\"card-body\">
                                <br>
                                <a href=\"classroom_stream.php?id=$classid\">
                                    <p class='card-title truncate'>$classname</p>
                                    <p class='card-title truncate'>$classteacherName</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>";
                        }
                    }elseif ($_SESSION['role'] == 'adm'){
                        while($rowClassAdmin= mysqli_fetch_assoc($resultClassAdmin)) {
                            $classid = $rowClassAdmin['class_id'];
                            $classteacherName = $rowClassAdmin['fullName'];
                            $classavatar = $rowClassAdmin['classAvatar'];
                            $classname = $rowClassAdmin['className'];
                            $classsubject = $rowClassAdmin['subject'];
                            echo "<div class=\"col-3 margin_bottom_card\" draggable='true'>
                    <div class=\"m-3\">
                        <div class=\"card\">
                            <img class=\"card-img-top card-size\" src='$classavatar' alt=''>
                            <div class=\"card-body\">
                                <br>
                                <a href=\"classroom_stream.php?id=$classid\">
                                    <h4 class=\"card-title truncate \">$classname</h4>
                                    <h5 class=\"card-creator\">$classteacherName</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>";
                        }
                    }
                }
            }

            ?>

        </div>

        <?php // Show error if password is incorrect, will be updated later
        if(isset($_SESSION['errorsPassword'])){
            if($_SESSION['errorsPassword'] == 1){
                echo "<div class='alertLogin'>Wrong username or password</div>".$_SESSION['result'];
                session_unset();
            }
        }
        ?>
    </div>






    <!-- ====================================== Card List View ======================================-->


</main>

<footer>
    <script src="./js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</footer>
</body>
</html>