/*PREVENT PRE-ANIMATING OF ELEMENTS */
window.onload=document.body.classList.remove("preload");

// Generating Avatar random colorize circle
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

// =================================================================================================
// =================================================================================================

// =============================================== PASSWORD
const password = document.getElementById("password-register");
const confirmPassword = document.getElementById("confirm-password-register");

password.addEventListener('keyup', function() {

    const pwd = password.value;

    // Reset if password length is zero
    if (pwd.length === 0) {
        document.getElementById("progresslabel").innerHTML = "";
        document.getElementById("progress").value = "0";
        return;
    }

    // Check progress
    let prog = [/[$@$!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
        .reduce((memo, test) => memo + test.test(pwd), 0);

    // Length must be at least 8 chars
    if(prog > 2 && pwd.length > 7){
        prog++;
    }

    // Display it
    let progress = "";
    let strength = "";
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
// =================================================================================================
// =================================================================================================

// ================== Function for validate password in recovery-password
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
// =================================================================================================
// =================================================================================================

// This will show image preview in modal classroomUI when adding new background
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
// =================================================================================================
// =================================================================================================

// =================================================================================================
// =================================================================================================

// Showing element information in class-stream

function showClassInforms() {
    const element_content = document.getElementsByClassName('class-information')[0];

    if(element_content.style.visibility == 'hidden'){
        element_content.style.visibility = 'visible';
        element_content.style.height = 87 + 'px';
        element_content.style.padding = '24px';
    }else{
        element_content.style.visibility = 'hidden';
        element_content.style.height = '0px';
        element_content.style.padding = '0px';
    }
}

// =================================================================================================
// =================================================================================================

// Showing file in the comment textarea

document.getElementById('upload').onchange = uploadOnChange;

function uploadOnChange() {
    var filename = this.value;
    var lastIndex = filename.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename = filename.substring(lastIndex + 1);
    }
    document.getElementById('filename').innerHTML = filename;
}

// Showing class comment

function showClassComment() {
    const commentVisible = document.getElementsByClassName("comment_show")[0];
    const commentArea = document.getElementsByClassName("comment-area")[0];
    if(commentVisible.style.display == "block"){
        commentVisible.style.display = "none";
        commentArea.style.display = "block";
    }else{
        commentVisible.style.display = "block";
        commentArea.style.display = "none";
    }
}