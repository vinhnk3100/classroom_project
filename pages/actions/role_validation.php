<?php
    session_start();
    //===================================== Connect to Database =====================================
    require ('database.php');
    if(isset($_POST['save-btn-submit'])){
        $role = mysqli_real_escape_string($db, $_POST['role-edit']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);

        $query = "SELECT * FROM users WHERE user_id = '$uid'";
        $result = mysqli_query($db,$query);
        $rows = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) == 1){
            $_SESSION['saveMsg'] = $role;
            if($role == "Teacher"){
                $role = "tea";
                mysqli_query($db,"UPDATE users set role = '$role' WHERE user_id = '$uid'");
                $_SESSION['saveMsg'] = $uid;
                header("Location: /myownclassroom/pages/manage.php");
            }elseif($role == "Student"){
                $role = "stu";
                mysqli_query($db,"UPDATE users set role = '$role' WHERE user_id = '$uid'");
                $_SESSION['saveMsg'] = $uid;
                header("Location: /myownclassroom/pages/manage.php");
            }
        }
    }

    if(isset($_POST['delete-btn-submit'])){
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        
        $query = "SELECT * FROM users WHERE user_id = '$uid'";
        $result = mysqli_query($db,$query);
        $rows = mysqli_fetch_assoc($result);


        if(mysqli_num_rows($result) == 1){
            mysqli_query($db,"ALTER TABLE users_class DROP FOREIGN KEY IF EXISTS FK_userIDTeacher;
                        DELETE FROM users WHERE user_id = '$uid'");
            header("Location: /myownclassroom/pages/manage.php");
        }

    }

?>
