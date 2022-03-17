function Login(username, password) {
    if (username == "") {
        document.getElementById("LoginWrongUsername").style.display = "block";
        return;
    }
    else {
        document.getElementById("LoginWrongUsername").style.display = "none";
    }

    if (password == "") {
        document.getElementById("LoginWrongPassword").style.display = "block";
        return;
    }
    else {
        document.getElementById("LoginWrongPassword").style.display = "none";
    }

    var loginData = JSON.stringify({ "username": username, "password": password });
    $.ajax({
        url: "php/login.php",
        type: "POST",
        dataType: "json",
        data: {
            json: loginData
        },
        success: function (data) {
            console.log("ID: " + data);
        },
        error: function () {
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("error").style.display = "block";
        }
    });
}

function Signup(name, username, password) {
    if (name == "") {
        document.getElementById("SignupNotValidName").style.display = "block";
        return;
    }
    else {
        document.getElementById("SignupNotValidName").style.display = "none";
    }
    if (username == "") {
        document.getElementById("SignupNotValidUsername").style.display = "block";
        return;
    }
    else {
        document.getElementById("SignupNotValidUsername").style.display = "none";
    }

    if (password == "" || password.length < 8 || password.length > 32) {
        document.getElementById("SignupNotValidPassword").style.display = "block";
        return;
    }
    else {
        document.getElementById("SignupNotValidPassword").style.display = "none";
    }

    var signupData = JSON.stringify({ "name": name, "username": username, "password": sha256(password) });
    console.log(signupData);
    $.ajax({
        url: "php/signup.php",
        type: "POST",
        dataType: "json",
        data: {
            signupData: signupData
        },
        success: function () {
            location.href = "/Museo/"
        },
        error: function (data) {
            console.log(data);
            document.getElementById("signupForm").style.display = "none";
            document.getElementById("error").style.display = "block";
        }
    });
}

function SwitchForms() {
    var LoginForm = document.getElementById("loginForm");
    var SignupForm = document.getElementById("signupForm");

    if (LoginForm.style.display == "none") {
        LoginForm.style.display = "block";
        SignupForm.style.display = "none";
    }
    else if (SignupForm.style.display == "none") {
        LoginForm.style.display = "none";
        SignupForm.style.display = "block";
    }
}