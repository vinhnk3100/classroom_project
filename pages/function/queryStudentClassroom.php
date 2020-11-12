<?php

require ('./actions/database.php');

// =================================================================================================================
// =================================================================================================================

//Query for student in each class
$queryStudent = "SELECT * FROM users_class, class, users WHERE users_class.user_id = '$uid' AND users_class.class_id = class.class_id AND users.user_id = class.teacher_id";
$resultStudent = mysqli_query($db,$queryStudent);

// ===============================================================================================================
// ========================================== IF SESSION LOGIN IS STUDENT ========================================
// ===============================================================================================================

if ($_SESSION['role'] == 'stu'){
    while($rowStudent = mysqli_fetch_assoc($resultStudent)){
        $classid = $rowStudent['class_id'];
        $classteacherName= $rowStudent['fullName'];
        $classavatar = $rowStudent['classAvatar'];
        $classname = $rowStudent['className'];
        $_POST['classname'] = $classname;
        echo "<div class=\"col-3 margin_bottom_card\" draggable='true'>
                    <div class=\"m-3 mx-auto\">
                        <div class=\"card\">
                            <img class=\" card-size\" src='./css/backgroundImages/$classavatar' alt=''>
                            <div class=\"card-body\">
                                <br>
                                <a class='card-text-decoration' href=\"classroom_stream.php?class_id=$classid\">
                                    <h4 class='card-title truncate card-text-decoration'>$classname</h4>
                                    <h5 class='card-creator'>Teacher: $classteacherName</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>";
    }
}