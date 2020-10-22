<?php

require ('./actions/database.php');

// =================================================================================================================
// =================================================================================================================

// Query for showing class teacher (creator)
$queryTeacher = "SELECT * FROM users, class WHERE users.user_id = class.teacher_id AND class.teacher_id = '$uid' ";
$resultTeacher = mysqli_query($db,$queryTeacher);

// =================================================================================================================
// ================================== CHECK SESSION IF LOGIN IS TEACHER =============================================
// =================================================================================================================

if($_SESSION['role'] == 'tea'){
    while($rowTeacher = mysqli_fetch_assoc($resultTeacher)) {
        $classid = $rowTeacher['class_id'];
        $classteacherName= $rowTeacher['fullName'];
        $classavatar = $rowTeacher['classAvatar'];
        $classname = $rowTeacher['className'];
        $_POST['classname'] = $classname;
        echo "<div class=\"col-3 margin_bottom_card\" draggable='true'>
                    <div class=\"m-3\">
                        <div class=\"card\">
                            <img class=\" card-size\" src='$classavatar' alt=''>
                            <div class=\"card-body\">
                                <br>
                                <a class='card-text-decoration' href=\"classroom_stream.php?id=$classid\">
                                    <h4 class='card-title truncate card-text-decoration'>$classname</h4>
                                    <h5 class='card-creator'>Teacher: $classteacherName</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>";
    }

}