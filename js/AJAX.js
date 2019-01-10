var username = document.querySelector("#name");

function print_username_err(event) {
    var error_msg = document.getElementById("name-err");
    error_msg.innerHTML = event.target.responseText;

    if (error_msg.innerHTML) {
        username.classList.add("w3-border-red");
    } else {
  	    username.classList.remove("w3-border-red");
    }
}

function check_username_ajax(event) {
    var url = "form_management/user_create.php?name=" + encodeURIComponent(username.value);

    var r = new XMLHttpRequest();
    r.open("GET", url, true);
    r.send();
    r.addEventListener("load", print_username_err);
}

username.addEventListener("blur", check_username_ajax);


var email = document.querySelector("#email");

function print_email_err(event) {
    var error_msg = document.getElementById("email-err");
    error_msg.innerHTML = event.target.responseText;

    if (error_msg.innerHTML) {
        email.classList.add("w3-border-red");
    } else {
  	    email.classList.remove("w3-border-red");
    }
}

function check_email_ajax(event) {
    var url = "form_management/user_create.php?email=" + encodeURIComponent(email.value);

    var r = new XMLHttpRequest();
    r.open("GET", url, true);
    r.send();
    r.addEventListener("load", print_email_err);
}

if (email) {
    email.addEventListener("blur", check_email_ajax);
}
