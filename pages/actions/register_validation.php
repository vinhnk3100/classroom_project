<?php
session_start();


//connect to database
require ('database.php');

//REGISTER USER 
if (isset($_POST['register-btn-submit'])){
    //receive values from the form
  
    $fullName = mysqli_real_escape_string($db, $_POST['users-fullname-register']);
    $email = mysqli_real_escape_string($db, $_POST['users-email-register']);
    $phone = mysqli_real_escape_string($db, $_POST['users-phone-register']);
    $DOB = mysqli_real_escape_string($db, $_POST['users-dob-register']);
    $password = mysqli_real_escape_string($db, $_POST['users-password-register']);
    $passwordConfirm = mysqli_real_escape_string($db, $_POST['users-password-confirm-register']); 

    //Check DB for duplicate information with the current 
    $falseCheck = true;
    $user_check_query = "SELECT * FROM users WHERE fullName='$fullName' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $checkUser = mysqli_fetch_assoc($result);

    if($checkUser){ //if user already exists
        if($checkUser['fullName'] === $fullName){   
          $_SESSION["existErrorFullName"] = true;
          $falseCheck = false;
        }

        if($checkUser['email'] === $email){
          $_SESSION["existErrorEmail"] = true;
          $falseCheck = false;
          }  
        }

        if($falseCheck){
        //$passwordEnc = md5($password); //Encrypted password
        $user_id = uniqid('user');
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO users (user_id,email,passWord, fullName, dateOfBirth, phoneNum)
                    VALUES('$user_id','$email','$pass_hash','$fullName','$DOB','$phone')";
    

        //check if database error
        if ($db->query($insertQuery) === TRUE) {
          $_SESSION["dbAddedSuccess"]= true;
          header("Location: ../login_form.php");
            
          } else {
            echo "Error: " . $insertQuery . "<br>" . $db-> error;
          }
        } else {
          header("Location: ../register.php");
        }

      
} else echo ("fAIL");
  

?>