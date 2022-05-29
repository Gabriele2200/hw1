


function checkName(event) {

    if (event.currentTarget.value.length > 0 && event.currentTarget.value.length < 15) {
        document.querySelector('#name_error').classList.add("hidden");
        if (event.currentTarget == document.querySelector('.name input')) CHECK_F.name = true;
        else CHECK_F.surn = true;
    }
    else {
        document.querySelector('#name_error').classList.remove("hidden");
        if (event.currentTarget == document.querySelector('.name input')) CHECK_F.name = false;
        else CHECK_F.surn = false;
    }
}

function jsonCheckusername(json) {
    if (s.usernamename = !json.exists) {
        document.querySelector('#username_error').textContent = "Username non valido (max 13)";
        document.querySelector('#username_error').classList.add('hidden');
        CHECK_F.username = true;
    } else {
        document.querySelector('#username_error').textContent = "Questo username è già in uso";
        document.querySelector('#username_error').classList.remove('hidden');
        CHECK_F.username = false;
    }
}

function jsonCheckEmail(json) {
    if (s.email = !json.exists) {
        document.querySelector('#email_error').textContent = "email non valida"; 
        document.querySelector('#email_error').classList.add('hidden');
        CHECK_F.email = true;
    } else {
        document.querySelector('#email_error').textContent = "email già in uso";
        document.querySelector('#email_error').classList.remove('hidden');
        CHECK_F.email = false;
    }
}

function fetchResponse(response) {
    return (response.ok ? response.json() : null);
}

function checkusername(event) {
    const username = document.querySelector('.username input');

    if (!/^[a-zA-Z0-9_]{1,13}$/.test(username.value)) {
        document.querySelector('#username_error').classList.remove("hidden");
        CHECK_F.username = false;
    } else {
        fetch("json_check.php?usr=" + encodeURIComponent(username.value)).then(fetchResponse).then(jsonCheckusername);
    }
}

function checkEmail(event) {
    const addr = document.querySelector('.email input');

    if (!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(addr.value).toLowerCase())) {
        document.querySelector('#email_error').classList.remove("hidden");
        CHECK_F.email = false;
    } else {
        fetch("json_check.php?email=" + encodeURIComponent(String(addr.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword(event) {
    const pass = document.querySelector('.password input');
    if (s.password = pass.value.length >= 6) {
        document.querySelector('#password_error').classList.add('hidden');
        CHECK_F.passw = true;
    } else {
        document.querySelector('#password_error').classList.remove('hidden');
        CHECK_F.passw = false;
    }
}



const s = { 'up': true };
let CHECK_F = {
    name: false,
    surn: false,
    username: false,
    passw: false,
    email: false,
};

function T_Check(event) {
    let fCheck = 0;
    for (const f in CHECK_F) {
        if (CHECK_F[f] == false) fCheck++;
    }

    if (fCheck) {
        event.preventDefault();
        document.querySelector('#final_error').classList.remove('hidden');
    }
}

document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkName);
document.querySelector('.username input').addEventListener('blur', checkusername);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.forms['nome_form'].addEventListener('submit', T_Check);





function Check_login(event) {
    if (form.usernamename.value.length == 0 || form.password.value.length == 0) {
        event.preventDefault();
        document.querySelector('.login_error').classList.remove("hidden");
    }
}

const form = document.forms['nome_form_l'];
form.addEventListener('submit', Check_login);