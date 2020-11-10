<?php
// =========================================== REQUEST JOIN CLASSROOM ==================================================
// =====================================================================================================================

// This action is getting request mail join classroom from student to teacher

session_start();
require ('database.php');
    // This action send link to email to get to access into page password_recovery.php
    $user_email = $_SESSION['useremail'];
    $headers = 'From: '.$user_email. "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-Type: text/html; charset=utf-8';

    //connect database
    

    if  (isset($_POST['btn_join_class'])){
        // ====== receive values from the form
        $class_id  = mysqli_real_escape_string($db, $_POST["classroom-code"]);

        $teacher_email = "SELECT email, fullName, className FROM users, class  
            WHERE user_id in(SELECT teacher_id from class WHERE class_id='$class_id')";
        $result_teacher_email = mysqli_query($db, $teacher_email);

        $query = "SELECT class_id FROM class WHERE class_id = '$class_id  '";
        $result= mysqli_query($db, $query);

        // ====== Check if class_id from form is exist in database
        if(mysqli_num_rows($result) == 1)
        {
            // ====== Get the teacher email
            if($rowTeacher= mysqli_fetch_assoc($result_teacher_email)){
                $classname = $rowTeacher['className'];
                $teacherEmail = $rowTeacher['email'];
                $message = "
                    <form action=\"http://localhost/myownclassroom/pages/actions/accept_request_join_class.php\" method=\"post\">
                        <div style='font-size: 24px;margin-left: 1rem'>$user_email request to join your <strong style='color: red'>$classname</strong>.</div>
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
                $result = mail($teacherEmail,"REQUEST JOIN CLASSROOM",$message,$headers);
                header("Location: ../home.php");
            }
        }else{
            $_SESSION['valid_classroom'] = 0;
            header("Location: ../home.php");
        }
    }
?>