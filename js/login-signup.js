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

    var loginData = JSON.stringify({ "username": username.toLowerCase(), "password": sha256(password) });
    $.ajax({
        url: "php/login.php",
        type: "POST",
        dataType: "json",
        data: {
            loginData: loginData
        },
        success: function (data) {
            location.href = "/";
        },
        error: function (data) {
            switch (data.status) {
                case 501:
                    document.getElementById('LoginWrongUsername').style.display = "block";
                    return;
                case 502:
                    document.getElementById('LoginWrongPassword').style.display = "block";
                    return;
                default:
                    document.getElementById("errorText").textContent = data.responseText;
                    document.getElementById("loginForm").style.display = "none";
                    document.getElementById("error").style.display = "block";
            }
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

    var signupData = JSON.stringify({ "name": name, "username": username.toLowerCase(), "password": sha256(password) });
    console.log(signupData);
    $.ajax({
        url: "php/signup.php",
        type: "POST",
        dataType: "json",
        data: {
            signupData: signupData
        },
        success: function () {
            location.href = "/";
        },
        error: function (data) {
            console.log(data);
            let signupForm = document.getElementById("signupForm");
            let error = document.getElementById("error");
            let errorText = document.getElementById("errorText");

            switch (data.status) {          
                case 504:
                    document.getElementById("SignupAlreadyTakenName").style.display = "block";
                    break;

                case 501:
                case 502:
                case 503:
                default:
                    errorText.textContent = data.responseText;
                    signupForm.style.display = "none";
                    error.style.display = "block";
                    break;
            }

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