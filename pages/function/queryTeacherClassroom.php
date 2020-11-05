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
                            <img class=\" card-size\" src='./css/backgroundImages/$classavatar' alt=''>
                            <!-- =========================== DROPDOWN ACTION ======================================= -->
                            <ul class=\"navbar-nav margin-dropdown action_btn\">
                            <li class=\"nav-item dropdown\">
                                <a class=\"nav-link btn btn-outline-success my-2 action_btn_cog table_btn_right\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fa fa-cog\" aria-hidden=\"true\"></i></a>
                                <div class=\"dropdown-menu dropdown-style\" aria-labelledby=\"navbarDropdown\">
                                <div class=\"text-center margin-dropdown\"><a href=\"#\"  data-toggle=\"modal\" class=\"color-green-btn btn btn-outline-success my-2 my-sm-0 btn-width-style\" >Edit</a></div>
                                    <div class=\"text-center margin-dropdown\"><a href=\"#modal-delete-classroom\" data-toggle=\"modal\" class=\"color-red-btn btn btn-outline-success my-2 my-sm-0 btn-width-style\" >Remove</a></div>
                                </div>
                            </li>
                        </ul>
                            <div class=\"card-body\">
                                <br>
                                <a class='card-text-decoration' href=\"classroom_stream.php?id=$classid\">
                                    <h4 class='card-title truncate card-text-decoration'>$classname</h4>
                                    <h5 class='card-creator'>Teacher: $classteacherName</h5>
                                </a>
                                
                                <div id=\"modal-delete-classroom\" class=\"modal fade\">
    <div class=\"modal-dialog modal-join-classroom\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h4 class=\"modal-title alertLogin\">Are you sure you want to delete this classroom ?</h4>
            </div>
            
        </div>
    </div>
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
