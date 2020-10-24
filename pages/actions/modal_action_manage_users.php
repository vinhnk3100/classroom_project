<?php

require ('database.php');

$uid = $_GET['id'];

$query = "SELECT * FROM users";
$teacher = mysqli_query($db,$query);
$student = mysqli_query($db,$query);
$result = mysqli_query($db,$query);

$rows = mysqli_fetch_assoc($result);

