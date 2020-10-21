

// Generating Avatar random colorize
const colors = ['#00AA55', '#009FD4', '#B381B3', '#939393', '#E3BC00', '#D47500', '#DC2A2A'];

function numberFromText(text) {
    // numberFromText("AA");
    const charCodes = text
        .split('') // => ["A", "A"]
        .map(char => char.charCodeAt(0)) // => [65, 65]
        .join(''); // => "6565"
    return charCodes;
}

const avatars = document.querySelectorAll('.circle');

avatars.forEach(circle => {
    const text = circle.innerText; // => "AA"
    circle.style.backgroundColor = colors[numberFromText(text) % colors.length]; // => "#DC2A2A"
});

//PASSWORD
var password = document.getElementById("password-register");
var confirmPassword = document.getElementById("confirm-password-register");

password.addEventListener('keyup', function() {

       var pwd = password.value
//     var pwdc = confirmPassword.value;
//
//     if(pwd != pwdc){
//         document.getElementById("passwordChangeMsg").innerHTML = "Password must be the same !";
//         document.getElementById("submit-button").style.display = "none";
//         return false;
//     }else if (pwd == pwdc){
//         document.getElementById("passwordChangeMsg").innerHTML = "";
//         document.getElementById("submit-button").style.display = "block";
//     }

    // Reset if password length is zero
    if (pwd.length === 0) {
        document.getElementById("progresslabel").innerHTML = "";
        document.getElementById("progress").value = "0";
        return;
    }

    // Check progress
    var prog = [/[$@$!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
        .reduce((memo, test) => memo + test.test(pwd), 0);

    // Length must be at least 8 chars
    if(prog > 2 && pwd.length > 7){
        prog++;
    }

    // Display it
    var progress = "";
    var strength = "";
    switch (prog) {
        case 0:
        case 1:
        case 2:
            strength = "25%";
            progress = "25";
            break;
        case 3:
            strength = "50%";
            progress = "50";
            break;
        case 4:
            strength = "75%";
            progress = "75";
            break;
        case 5:
            strength = "100% - Password strength is good";
            progress = "100";
            break;
    }
    document.getElementById("progresslabel").innerHTML = strength;
    document.getElementById("progress").value = progress;

});

//confirmPassword.addEventListener('keyup', function () {
//     var pw = password.value;
//     var cpw = confirmPassword.value;
//
//     if(pw != cpw){
//         document.getElementById("passwordChangeMsg").innerHTML = "Password must be the same !";
//         document.getElementById("submit-button").style.display = "none";
//         return false;
//     }else if (pw == cpw){
//         document.getElementById("passwordChangeMsg").innerHTML = "";
//         document.getElementById("submit-button").style.display = "block";
//     }
// })

function validate() {
    const password = document.getElementById("password-register").value;
    const confirmPassword = document.getElementById("confirm-password-register").value;
    if(password != confirmPassword){
        document.getElementById("passwordChangeMsg").innerHTML = "Password must be same !";
        return false;
    }else{
        document.forms["form-password-recovery"].submit();
    }
}

// This will show image preview in modal classroomUI
function getImage() {
    const image_insert = document.getElementById("images-class-background");
    const image_preview = document.getElementById("image-class-preview");
    const reader = new FileReader();

    image_insert.onchange = function () {
        reader.onload = function (e) {
            image_preview.src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    }
}

