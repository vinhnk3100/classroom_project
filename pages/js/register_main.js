const form = document.getElementById("registerForm");


/*
form.addEventListener('submit', (e) => {
        e.preventDefault();

        if(registerValidation(form)){
                document.forms['registerForm'].submit();
                alert("Form submitted !");
    }

});*/

function registerCheck(){
    if(registerValidation(form)){
        document.forms['registerForm'].submit();
       // alert("Form submitted !");
    }
    
}
function registerValidation(form){
const fullName = form["users-fullname-register"];
const email = form["users-email-register"];
const phone = form["users-phone-register"];
const dob = form["users-dob-register"];
const pass = form["users-password-register"];
const rePass = form["users-password-confirm-register"];
var checkTrue = true;
  
    //fullName validation
    if(fullName == null || fullName.value.trim() === ''){
        setError(fullName, 'Your fullname is required! Please fill the blank!');
        checkTrue = false;

    } else {
        setSuccess(fullName);
    }


    //email validation
    if(email == null || email.value.trim() === ''){
        setError(email, 'Your email is required! Please fill the blank!');
        checkTrue = false;

    } else if(!isEmail(email.value.trim())){
            setError(email, 'EMail is not valid!');
            checkTrue = false;
    } 
    else {
        setSuccess(email);
    } 


    //phone validation
    if(phone == null||phone.value.trim() === ''){
        setError(phone, 'Your phone number is required! Please fill the blank!');
        checkTrue = false;

    } else if(isPhone(phone.value.trim()) == 0){
        setError(phone, 'Please provide a 10-digit phone number!');
        checkTrue = false;
    } 
    else {
        setSuccess(phone);
    }
    

    // DOB validation
    if(dob == null||dob.value.trim() === ''){
        setError(dob, 'Your date of birth is required! Please fill the blank!');
        checkTrue = false;

    }/*else if(!legitYear(dob.value.trim())){
        setError(dob, 'Please provide a valid date of birth!')
        return false;
    } */
    else {
        setSuccess(dob);
    }


    //password1 validation
    if(pass == null ||pass.value.trim() === ''){
        setError(pass, 'Password is required! Please fill the blank!');
        checkTrue = false;

    }/*else if(passWordValidation(pass.value.trim())){
        setError(pass,'Password minimum length is 8 and contain at least one uppercase letter!');
        checkTrue= false;
    } */
     else {
        setSuccess(pass);
    }


    //password2 validation
    if(rePass == null ||rePass.value.trim() === ''){
        setError(rePass, 'Please validate your password!');
        checkTrue = false;

    } else if(rePass.value.trim() != pass.value.trim()){
        setError(rePass, 'Password does not match!');
        checkTrue = false;
    }
    
    else {
        setSuccess(rePass);
    }


   
    //validate email format
    function isEmail(email){
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    }


    //validate phone format -10 digits
    function isPhone(phone){
        return /^\d{10}$/.test(phone);
    }

    /*function legitYear(year){
        var inputYear = new Date(year.getFullYear,0);
           return (new Date().getFullYear() - inputYear < 0)
    }*/


    /*function passWordValidation(pass){
        var result = false;
          if(pass.match( /[A-Z]/g) && pass.match( 
                 /[0-9]/g)  && pass.length >= 8){
                        result = true;
                 }
            return result;
    } */



     //set message if error
     function setError(input, message){
        const registerForm = input.parentElement;
        const small = registerForm.querySelector('small');
        registerForm.className = 'wrap-input100 error';

        //display error message in small
        small.innerText = message;

    }

    //set action if success
    function setSuccess(input){
        const registerForm =  input.parentElement;
        registerForm.className = 'wrap-input100 success';
    }

    return checkTrue;

}


