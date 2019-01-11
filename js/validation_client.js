// Tento soubor obsahuje validaci v Javascriptu "on submit", která probíhá na straně klienta.
// Každý formulář je zde zastoupen 1 funkcí.

// Registrace

var signup_form = document.querySelector("#signup-form");

function check_signup_form(event) {

    // Uživatelské jméno

    var username = document.querySelector("#name");
    var span_username = document.querySelector("#name-err");

    if ((username.value.length > 0) && (username.value.length <= 20)) {
  	    username.classList.remove("w3-border-red");
        span_username.innerHTML = "";
    } else {
        event.preventDefault();
        username.classList.add("w3-border-red");
        span_username.innerHTML = "Uživatelské jméno musí obsahovat 1 - 20 znaků";
    }

    // Email

    var email = document.querySelector("#email");
    var span_email = document.querySelector("#email-err");

    if ((email.value.length > 0) && (email.value.indexOf("@") != -1) && (email.value.length <= 100)) {
  	    email.classList.remove("w3-border-red");
        span_email.innerHTML = "";
    } else {
        event.preventDefault();
        email.classList.add("w3-border-red");
        span_email.innerHTML = "Email musí být vyplněný a obsahovat zavináč (povoleno maximálně 100 znaků)";

    // Heslo

    var password = document.querySelector("#pw");
    var span_password = document.querySelector("#pw-err");

    if (password.value.length > 0) {
  	    password.classList.remove("w3-border-red");
        span_password.innerHTML = "";
    } else {
        event.preventDefault();
        password.classList.add("w3-border-red");
        span_password.innerHTML = "Heslo musí být vyplněné";
    }
}

if (signup_form) {
    signup_form.addEventListener("submit", check_signup_form);
}



// Přihlášení

var signin_form = document.querySelector("#signin-form");

function check_signin_form(event) {

    // Uživatelské jméno

    var username = document.querySelector("#name");
    var span_username = document.querySelector("#name-err");

    if ((username.value.length > 0) && (username.value.length <= 20)) {
  	    username.classList.remove("w3-border-red");
        span_username.innerHTML = "";
    } else {
        event.preventDefault();
        username.classList.add("w3-border-red");
        span_username.innerHTML = "Uživatelské jméno musí obsahovat 1 - 20 znaků";
    }

    // Heslo

    var password = document.querySelector("#pw");
    var span_password = document.querySelector("#pw-err");

    if (password.value.length > 0) {
  	    password.classList.remove("w3-border-red");
        span_password.innerHTML = "";
    } else {
        event.preventDefault();
        password.classList.add("w3-border-red");
        span_password.innerHTML = "Heslo musí být vyplněné";
    }
}

if (signin_form) {
    signin_form.addEventListener("submit", check_signin_form);
}



// Nový příspěvek

var entry_form = document.querySelector("#new-entry-form");

function check_entry_form(event) {

    // Téma

    var topic = document.querySelector("#topic");
    var span_topic = document.querySelector("#span-topic");

    if (topic.hasOwnProperty('value')) {
        topic.classList.remove("w3-border-red");
        span_topic.innerHTML = "";
    } else {
        event.preventDefault();
        topic.classList.add("w3-border-red");
        span_topic.innerHTML = "Vyberte prosím téma z nabídky";
    }

    // Nadpis

    var title = document.querySelector("#title");
    var span_title = document.querySelector("#span-title");

    if ((title.value.length > 0) && (title.value.length <= 50)) {
        title.classList.remove("w3-border-red");
        span_title.innerHTML = "";
    } else {
        event.preventDefault();
        title.classList.add("w3-border-red");
        span_title.innerHTML = "Nadpis musí obsahovat 1 - 50 znaků";
    }

    // Tělo

    var body = document.querySelector("#entry");
    var span_body = document.querySelector("#span-body");

    if ((body.value.length > 0) && (body.value.length <= 65000)) {
        body.classList.remove("w3-border-red");
        span_body.innerHTML = "";
    } else {
        event.preventDefault();
        body.classList.add("w3-border-red");
        span_body.innerHTML = "Příspěvek musí obsahovat 1 - 65000 znaků";
    }
}

if (entry_form) {
    entry_form.addEventListener("submit", check_entry_form);
}



// Přidávání kategorie

var new_cat_form = document.querySelector("#add-topic-form");

function check_new_cat(event) {

    var new_cat = document.querySelector("#topic-name");
    var span_new_cat = document.querySelector("#span-new-topic");

    if ((new_cat.value.length > 0) && (new_cat.value.length <= 20)) {
        new_cat.classList.remove("w3-border-red");
        span_new_cat.innerHTML = "";
    } else {
        event.preventDefault();
        new_cat.classList.add("w3-border-red");
        span_new_cat.innerHTML = "Název tématu musí obsahovat 1 - 20 znaků";
    }
}

if (new_cat_form) {
    new_cat_form.addEventListener("submit", check_new_cat);
}



// Mazání kategorie

var del_cat_form = document.querySelector("#del-topic-form");

function check_del_cat(event) {

    var del_cat = document.querySelector("#topic");
    var span_del_cat = document.querySelector("#span-del-topic");

    if (del_cat.hasOwnProperty('value')) {
        del_cat.classList.remove("w3-border-red");
        span_del_cat.innerHTML = "";
    } else {
        event.preventDefault();
        del_cat.classList.add("w3-border-red");
        span_del_cat.innerHTML = "Vyberte prosím téma z nabídky";
    }
}

if (del_cat_form) {
    del_cat_form.addEventListener("submit", check_del_cat);
}
