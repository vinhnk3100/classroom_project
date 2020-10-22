<?php

require ('./actions/database.php');

// =================================================================================================================
// =================================================================================================================

// Query for showing all the class for administrator
$queryClassAdmin = "SELECT * FROM class,users WHERE users.role = 'adm'";
$resultClassAdmin = mysqli_query($db,$queryClassAdmin);

// ===============================================================================================================
// ========================================== IF SESSION LOGIN IS ADMIN ==========================================
// ===============================================================================================================

if ($_SESSION['role'] == 'adm'){
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
                                <a class='card-text-decoration' href=\"classroom_stream.php?id=$classid\">
                                    <h4 class=\"card-title truncate card-text-decoration\">$classname</h4>
                                    <h5 class=\"card-creator\">Teacher: $classteacherName</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>";
    }
}