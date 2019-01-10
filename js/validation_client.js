//*sign up + sign in*
//username
var username = document.querySelector("#name");

function check_username(event) {
    if ((username.value.length > 0) && (username.value.length <= 20)) {
  	    username.classList.remove("w3-border-red");
    } else {
        event.preventDefault();
        username.classList.add("w3-border-red");
    }
}

if (username) {
    username.addEventListener("submit", check_username);
}

//email
var email = document.querySelector("#email");

function check_email(event) {
    if ((email.value.length > 0) && (email.value.indexOf("@") != -1) && (email.value.length <= 100)) {
  	    username.classList.remove("w3-border-red");
    } else {
        event.preventDefault();
        username.classList.add("w3-border-red");
    }
}

if (email) {
    email.addEventListener("submit", check_email);
}

//password
var password = document.querySelector("#pw");

function check_password(event) {
    if (password.value.length > 0) {
  	    password.classList.remove("w3-border-red");
    } else {
        event.preventDefault();
        password.classList.add("w3-border-red");
    }
}

if (password) {
    password.addEventListener("submit", check_password);
}

//*new entry*

var entry_form = document.querySelector("#new-entry-form");

function check_entry_form(event) {
    //topic
    var span_topic = document.querySelector("#span-topic");
    if (topic.hasOwnProperty('value')) {
        topic.classList.remove("w3-border-red");
        span_topic.innerHTML = "";
    } else {
        event.preventDefault();
        topic.classList.add("w3-border-red");
        span_topic.innerHTML = "Vyberte prosím téma z nabídky";
    }
    //title
    var span_title = document.querySelector("#span-title");
    if ((title.value.length > 0) && (title.value.length <= 50)) {
        title.classList.remove("w3-border-red");
        span_topic.innerHTML = "";
    } else {
        event.preventDefault();
        title.classList.add("w3-border-red");
        span_title.innerHTML = "Nadpis musí obsahovat 1 - 50 znaků";
    }
    //body
    var span_body = document.querySelector("#span-body");
    if ((entry.value.length > 0) && (entry.value.length <= 65000)) {
        entry.classList.remove("w3-border-red");
        span_topic.innerHTML = "";
    } else {
        event.preventDefault();
        entry.classList.add("w3-border-red");
        span_body.innerHTML = "Příspěvek musí obsahovat 1 - 65000 znaků";
    }
}

if (entry_form) {
    entry_form.addEventListener("submit", check_entry_form);
}

//*add category/topic*
var new_cat = document.querySelector("#topic-name");

function check_new_cat(event) {
    if ((new_cat.value.length > 0) && (new_cat.value.length <= 20)) {
        new_cat.classList.remove("w3-border-red");
    } else {
        event.preventDefault();
        new_cat.classList.add("w3-border-red");
    }
}

if (new_cat) {
    new_cat.addEventListener("submit", check_new_cat);
}
