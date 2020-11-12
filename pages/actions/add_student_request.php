<?php

// ========================================== INVITE STUDENT INTO CLASSROOM ===============================================
    // This action is getting request mail invite to classroom from teacher to student
require ("database.php");
session_start();

//=========================================== PREVENTING CROSS-SITE ATTACK =============================================

$classid = $_GET['class_id'];
$teacherID = $_SESSION['uid'];
include ("../function/prevent_cross.php");

// =====================================================================================================================

    // This action send link to email from student to teacher
    $teacher_email = $_SESSION['useremail'];
    $headers = 'From: '.$teacher_email. "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-Type: text/html; charset=utf-8';

    // If the button invite is clicked
if(isset($_POST['btn_invite_class'])){

    // =================== Get the email from form
    $student_email = mysqli_real_escape_string($db, $_POST["student_email_invite"]);

    //Get teacher, class informations
    $getClass = "SELECT teacher_id, className, email, fullName FROM class, users WHERE class_id = '$classid' AND teacher_id='$teacherID' AND user_id = '$teacherID'";
    $resultClass = mysqli_query($db, $getClass);


    // Check if student is existed
    $student_class = "SELECT email,user_id FROM users WHERE email='$student_email'";
    $queryStudent = mysqli_query($db,$student_class);

    if(mysqli_num_rows($queryStudent) == 1)
    {
        // ====== Get the teacher email
        if($rowClass = mysqli_fetch_assoc($resultClass)){
            $classname = $rowClass['className'];
            $teacherName = $rowClass['fullName'];
            $message = "
                    <form action=\"http://localhost/myownclassroom/pages/actions/accept_invite_join_class.php?class_id=$classid&stu_email=$student_email\" method=\"post\">
                        <div style='font-size: 24px;margin-left: 1rem'>$teacher_email invite you to join <strong style='color: red'>$classname</strong>.</div>
                            <input  type= \"submit\"
                                    style='color: white;
                                            margin-left: 30rem;
                                            background-color: green;
                                            margin-top: 2rem;
                                            font-size: 28px;
                                            border-radius: 6px;
                                            border: 2px solid #000000;'
                                    name = \"btn_create_class\"
                                    id=\"btn_create_class\"
                                    value=\"Accept\">
                    </form>
                ";
            // ====== Sendmail function
            $result = mail($student_email,"INVITE TO JOIN CLASSROOM ",$message,$headers);
            header("Location: ../home.php");
        }
    }else{
        $_SESSION['valid_email'] = 0;
        header("Location: ../classroom_everyone.php?class_id=$classid");
    }

}



?>