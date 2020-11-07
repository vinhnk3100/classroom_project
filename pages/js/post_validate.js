function post_valdate(){
    const postContent = document.getElementById("comment_textarea");
    const postButton = document.getElementById("btn_post");

    if(postContent != ''){
        postButton.disabled =true;
    } else{
        document.forms['postInt'].submit();
    }
 }
