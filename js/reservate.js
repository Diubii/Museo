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

function reservate(name, contact, n_people, entrance_time, username) {
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

    if (n_people < 1 || n_people > 5) {
        document.getElementById("NotValidNumber").style.display = "block";
        return;
    }
    else{
        document.getElementById("NotValidNumber").style.display = "none";
    }

    let dt = new Date(entrance_time);
    let result = dt.getUTCMinutes() % 5;
    //console.log("Date: " + dt + "; getUTCMinutes: " + dt.getUTCMinutes() + "; Result: " + result + ";");
    if (entrance_time == "" || result != 0) {
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


    var reservationData = JSON.stringify({"name": name, "contact": contact, "n_people": n_people, "entrance_time": entrance_time, "username": username});
    console.log(reservationData);
    $.ajax({
        url: "php/reservate.php",
        type: "POST",
        dataType: "json",
        data: {
            reservationData: reservationData
        },
        success: function (data) {
            console.log("ID: " + data);
            document.getElementById("reservationID").textContent = data;
            document.getElementById("form").style.display = "none";
            document.getElementById("success").style.display = "block";
        },
        error: function (data) {
            console.log(data);

            switch(data.status){
                case 501:
                    document.getElementById("AlreadyChosenDT").style.display = "block";
                    break;
                case 502:
                    document.getElementById("TooManyPeople").textContent = data.responseText;
                    document.getElementById("TooManyPeople").style.display = "block";
                    break;
                default:
                    document.getElementById("form").style.display = "none";
                    document.getElementById("error").style.display = "block";
            }
        }
    });
    console.log("Name: " + name + "\n Contact: " + contact + "\n People: " + n_people + "\n Entrance Time: " + entrance_time)
}