<?php
session_start();
if(isset($_SESSION['fullname'])){
    if($_SESSION['fullname'] != null){
        header("Location: /myownclassroom/pages/home.php");
    }
}
?>

<html>
<!DOCTYPE html>
<head>
    <title>Classroom</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="pages/css/style.css">
</head>

<body>
<main>
    <div>
        <!--====== NAVBAR TOP =======================-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="./pages/css/images/icons8-classroom-80.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="text-nav-bar" href="./home.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

            </div>
            <div class="text-center margin-dropdown"><a href="./pages/login_form.php" class="btn btn-outline-success my-2 my-sm-0 white_text" >Login</a></div>
            <div class="text-center margin-dropdown"><a href="./pages/register.php" class="btn btn-outline-success my-2 my-sm-0 white_text" >Sign up</a></div>
        </nav>
    </div>

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