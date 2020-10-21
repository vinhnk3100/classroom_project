<?php
session_start();
if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}elseif ($_SESSION['role'] != "adm"){
    header("Location: /myownclassroom/pages/home.php");
}

//===================================== Connect to Database =====================================
$db = mysqli_connect("localhost","root","admin1234","classroom_project");

//===================================== Check database connection =====================================
if ($db -> connect_errno) {
    echo "Failed to connect to MySQL: " . $db -> connect_error;
    exit();
}

$query = "SELECT * FROM users";
$teacher = mysqli_query($db,$query);
$student = mysqli_query($db,$query);
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
                        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
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
    </div>
    </nav>
    </div>


    <!--====== NAVBAR TOP =======================-->

    <!--=================================================================================================================-->
    <!--=================================================================================================================-->

    <!--====== LIST OF USERS ========================================-->

    //===================================== DATABASE QUERY =====================================
    <?php
    require ('actions/database.php');

    $query = "SELECT * FROM users";
    $queryStudent = "SELECT * FROM users WHERE role = 'stu'";
    $queryTeacher = "SELECT * FROM users WHERE role = 'tea'";

    $admin = mysqli_query($db,$query);
    $teacher = mysqli_query($db,$queryTeacher);
    $student = mysqli_query($db,$queryStudent);


    ?>

    <div class="center tbb">
        <table class="tablexpen">
            <div class="divline">
                <h2 class="colorlist giaovien">
                    Admin
                </h2>
            </div>
            <tbody>
            <tr>
                <td>
                    <div>
                        <?php
                        if (mysqli_num_rows($admin) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($admin)) {
                                if($row['role'] == "adm"){
                                    echo "<span><img class=\"imgcc\" area-hidden=\"true\" src=\"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/s32-c-fbw=1/photo.jpg\">"."<span class=\"tp tf\">".$row['fullName']."</span>"."</span>"."<br>";
                                }
                            }
                        }
                        ?><br><br><br>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

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
                        if (mysqli_num_rows($teacher) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($teacher)) {
                                if($row['role'] == "tea"){
                                    echo "<a href=\"users_infomation.php?id=".$row['user_id']."\" class=\"btn btn-outline-success my-2 my-sm- color-orange\" name=\"profile-button\">Profile</a>";
                                    echo "<span><img class=\"imgcc\" area-hidden=\"true\" src=\"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/s32-c-fbw=1/photo.jpg\">"."<span class=\"tp tf\">".$row['fullName']."</span>"."</span>".""."<br>";
                                }
                            }
                        }
                        ?><br><br><br>

                    </div>
                </td>
            </tr>
            </tbody>
        </table>

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
                        if (mysqli_num_rows($student) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($student)) {
                                if($row['role'] == "stu"){
                                    echo "<a href=\"users_infomation.php?id=".$row['user_id']."\" class=\"btn btn-outline-success my-2 my-sm- color-orange\" name=\"profile-button\">Profile</a>";
                                    echo "<span><img class=\"imgcc\" area-hidden=\"true\" src=\"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/s32-c-fbw=1/photo.jpg\">"."<span class=\"tp tf\">"."<a class='tf' href='#'>".$row['fullName']."</a>"."</span>"."</span>".""."<br>";
                                }
                            }
                        }
                        ?><br><br><br>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!--====== LIST OF USERS ========================================-->

    <!--=================================================================================================================-->
    <!--=================================================================================================================-->

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