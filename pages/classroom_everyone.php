<?php
session_start();
if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}

//===================================== Connect to Database =====================================
require ("actions/database.php");

$classid = $_GET['id'];

$query = "SELECT fullName,role FROM users, class WHERE users.user_id = class.teacher_id AND class.class_id = '$classid'";
$teacher = mysqli_query($db,$query);

$queryStudent = "SELECT fullName,role,users_class.user_id FROM users, users_class WHERE users.user_id = users_class.user_id AND users_class.class_id = '$classid'";
$student = mysqli_query($db,$queryStudent);
$result = mysqli_query($db,$query);

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
    <link rel="stylesheet" href="./css/classroom-stream.css">
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
                    <li class="nav-item dropdown">
                        <a class="text-nav-bar" href="./home.php">Home <span class="sr-only">(current)</span></a>
                        <a class="text-nav-bar dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Classroom
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            // =================================================== ROLE ACTION ===============================================
                            if (isset($_SESSION['role'])){
                                if($_SESSION['role'] == 'adm'){
                                    echo "<a href=\"./classroom_stream.php?id=$classid\" class=\"delete-class-btn dropdown-item \">Delete Classroom</a>";
                                }elseif ($_SESSION['role'] == 'tea'){
                                    echo "<a href=\"\" class=\"dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Delete Classroom</a>";
                                }
                            }?>
                        </div>
                    </li>
                </ul>
                <!--=================================================================================================================-->
                <!--=================================================================================================================-->


                <!-- Modal FOR CREATE CLASSROOM -->
                <div id="modal-delete-classroom" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Create classroom</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <!--./actions/class_create.php-->
                                <form action="./actions/class_create.php" method="post">
                                        <input type= "submit" class="btn btn-primary btn-block btn-lg" name = "btn_create_class" id="btn_create_class" value="Create">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

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
    </nav>
    <div class="nav_bar_2">
        <div class="nav_bar_2_item">
            <?php
            echo "<a class=\"nav_bar_2_text_b\" id=\"navtext\" onclick=\"myFunction()\" href=\"classroom_stream.php?id=$classid\" target=\"_self\"> Stream
            </a>";
            ?>

        </div>
        <div class="nav_bar_2_item">
            <?php
            echo "<a class=\"nav_bar_2_text_a\" id=\"navtext\" onclick=\"myFunction()\" href=\"http://localhost/myownclassroom/pages/classroom_everyone.php?id=$classid\" target=\"_self\"> Everyone
            </a>";
            ?>

        </div>
    </div>

        <!--=================================================================================================================-->
        <!--=================================================================================================================-->


    <!--====== NAVBAR TOP =======================-->

        <!--=========================================================================================================-->
        <!--============================================== TEACHER ==================================================-->

    <div class="center tbb">

        <div class="divline">
            <h2 class="colorlist giaovien">
                Teacher
            </h2>
        </div>
        <table class="tablexpen">
            <tbody>
            <tr>
                <td>
                    <div>
                        <?php
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($teacher)) {
                                if($row['role'] == "tea"){
                                    echo "<span><img class=\"imgcc\" area-hidden=\"true\" src=\"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/s32-c-fbw=1/photo.jpg\">"."<span class=\"tp tf\">".$row['fullName']."</span>"."</span>".""."<br>";
                                }
                            }
                        ?><br><br><br>

                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <!--=========================================================================================================-->
        <!--============================================== STUDENT ==================================================-->

        <div class="divline">
            <h2 class="colorlist giaovien">
                Student
            </h2>
        </div>
        <table class="tablexpen">
            <tbody>
            <tr>
                <td>
                    <div>
                        <?php
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($student)) {
                                if($row['role'] == "stu"){
                                    $stuName = $row['fullName'];
                                    $stuUID = $row['user_id'];
                                    $url = 'actions/remove_student.php?id='.$stuUID.'&class_id='.$classid.'';
                                    //<!--=========================================================================================================-->
                                    //<!--========================= ACTION ON STUDENT BY TEACHER ==================================================-->
                                    if($_SESSION['role'] == "tea"){
                                        echo "<ul class=\"navbar-nav margin-dropdown\">
                            <li class=\"nav-item dropdown\">
                                <a class=\"nav-link modal_users btn btn-outline-success my-2 my-sm- color-orange table_btn_right\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fa fa-cog\" aria-hidden=\"true\"></i></a>
                                <div class=\"dropdown-menu dropdown-style\" aria-labelledby=\"navbarDropdown\">
                                    <div class=\"text-center margin-dropdown\"><a href=\"$url\" class=\"color-red-btn btn btn-outline-success my-2 my-sm-0\" >Remove</a></div>
                                </div>
                            </li>
                        </ul>";
                                    }
                                    echo "<span><img class=\"imgcc\" area-hidden=\"true\" src=\"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/s32-c-fbw=1/photo.jpg\">"."<span class=\"tp tf\"'>".$row['fullName']."</span>"."</span>".""."<br>";
                                }
                            }
                        ?>

                        <br><br><br>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--====== LIST OF USERS ========================================-->

    <br><br><br>



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