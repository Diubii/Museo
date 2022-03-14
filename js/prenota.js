/*function reservate(name, contact, n_people, entrance_time){
    const xmlHttp = new XMLHttpRequest();
    xmlHttp.onload = function(){
        document.getElementById("form").style.display="none";
        document.getElementById("success").style.display="block";
    }

    xmlHttp.onerror = function(){
        document.getElementById("form").style.display="none";
        document.getElementById("error").style.display="block";
    }

    xmlHttp.open("POST", "php/prenota.php?n=" + name + "&c=" + contact + "&np=" + n_people + "&e=" + entrance_time);
    xmlHttp.send();
}*/

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        );
};

function reservate(name, contact, n_people, entrance_time) {
    //alert(validateEmail(contact));

    if (name == "") {
        document.getElementById("NotValidName").style.display = "block";
        return;
    }
    else{
        document.getElementById("NotValidName").style.display = "none";
    }

    if (n_people == NaN || n_people == "") {
        document.getElementById("NaN").style.display = "block";
        return;
    }
    else{
        document.getElementById("NaN").style.display = "none";
    }

    if (n_people < 1 && n_people > 5) {
        document.getElementById("NotValidNumber").style.display = "block";
        return;
    }
    else{
        document.getElementById("NotValidNumber").style.display = "none";
    }

    if (entrance_time == "") {
        document.getElementById("NotValidDT").style.display = "block";
        return;
    }
    else{
        document.getElementById("NotValidDT").style.display = "none";
    }

    if (validateEmail(contact) == null) {
        document.getElementById("NotValidEmail").style.display = "block";
        return;
    }
    else{
        document.getElementById("NotValidEmail").style.display = "none";
    }

    $.ajax({
        url: "php/prenota.php",
        type: "POST",
        dataType: "text",
        data: {
            n: name,
            c: contact,
            np: n_people,
            e: entrance_time
        },
        success: function () {
            document.getElementById("form").style.display = "none";
            document.getElementById("success").style.display = "block";
        },
        error: function () {
            document.getElementById("form").style.display = "none";
            document.getElementById("error").style.display = "block";
        }
    });
    console.log("Name: " + name + "\n Contact: " + contact + "\n People: " + n_people + "\n Entrance Time: " + entrance_time)
}




function closeError() {
    document.getElementById("form").style.display = "block";
    document.getElementById("error").style.display = "none";
}