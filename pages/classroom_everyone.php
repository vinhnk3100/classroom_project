<?php
session_start();
if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}

//===================================== Connect to Database =====================================
require ("actions/database.php");

$classid = $_GET['id'];

$queryClass = "SELECT * FROM class, users WHERE class.class_id = '$classid' AND users.user_id = class.teacher_id" ;
$resultClass = mysqli_query($db,$queryClass);
$rowsClass = mysqli_fetch_assoc($resultClass);

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
        <!--====== NAVBAR TOP =======================-->
        <?php include ("./function/nav-bar-actions-class.php")?>
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
                            // ============================ OUTPUT STUDENT DATA ROW ==============================
                            while ($row = mysqli_fetch_assoc($student)) {
                                if($row['role'] == "stu"){
                                    $stuName = $row['fullName'];
                                    $stuUID = $row['user_id'];
                                    $url = 'actions/remove_student.php?id='.$stuUID.'&class_id='.$classid.'';
                                    //<!--=========================================================================================================-->
                                    //<!--========================= ACTION ON STUDENT BY TEACHER ==================================================-->
                                    if($_SESSION['role'] == "tea" || $_SESSION['role'] == "adm" ){
                                        echo "<ul class=\"navbar-nav margin-dropdown\">
                            <li class=\"nav-item dropdown\">
                                <a class=\"round-btn-cyan table_btn_right\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a>
                                <div class=\"dropdown-menu dropdown-style\" aria-labelledby=\"navbarDropdown\">
                                    <div class=\"text-center margin-dropdown\"><a href=\"$url\" class=\"color-red-btn btn btn-outline-success my-2 my-sm-0\" >Remove</a></div>
                                </div>
                            </li>
                        </ul>";
                                    }
                                    echo "<span><img class=\"imgcc\" area-hidden=\"true\" src=\"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/s32-c-fbw=1/photo.jpg\">"."<span class=\"tp tf\"'>".$row['fullName']."</span>"."</span>".""."<br>";
                                }else{
                                    echo "";
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