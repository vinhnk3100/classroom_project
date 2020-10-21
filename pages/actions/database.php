<?php

//===================================== Connect to Database =====================================
$db = mysqli_connect("localhost","root","admin1234","classroom_project");

//===================================== Check database connection =====================================
if ($db -> connect_errno) {
    echo "Failed to connect to MySQL: " . $db -> connect_error;
    exit();
}
