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
                    <div class=\"m-3 mx-auto\">
                        <div class=\"card\">
                            <img class=\" card-size\" src='./css/backgroundImages/$classavatar' alt=''>
                            <!-- =========================== DROPDOWN ACTION ======================================= -->
                            <ul class=\"navbar-nav margin-dropdown action_btn\">
                        </ul>
                            <div class=\"card-body\">
                                <br>
                                <a class='card-text-decoration' href=\"classroom_stream.php?class_id=$classid\">
                                    <h4 class='card-title truncate card-text-decoration'>$classname</h4>
                                    <h5 class='card-creator'>Teacher: $classteacherName</h5>
                                </a>
                                
                                <div id=\"modal-delete-classroom\" class=\"modal fade\">
</div>
                            </div>
                        </div>
                    </div>
                </div>";
    }
}

?>

<!-- Modal for JOIN CLASSROOM  -->


<!-- END Modal for JOIN CLASSROOM  -->
