function DeleteReservation(id, loc){
    $.ajax({
        url: "php/deletereservation.php",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        },
        success: function() {
            location.href = loc;
        },
        error: function (data) {
            console.log(data);
            document.getElementById("error").style.display = "block";
        }
    });
}

function ShowEditReservation(id, el1, el2){
    $name = document.getElementById(id).childNodes[1].textContent;
    $n_people = document.getElementById(id).childNodes[2].textContent;
    $dt = document.getElementById(id).childNodes[3].textContent;
    $mail = document.getElementById(id).childNodes[4].textContent;

    if(document.getElementById("name").tagName == "LABEL"){
        document.getElementById("name").textContent = $name;
    }
    else{
        document.getElementById("name").value = $name;
    }
    
    document.getElementById("n_people").value = $n_people;
    document.getElementById("dtpicker").value = $dt;
    document.getElementById("contact").value = $mail;
    CurrentID = id;
    el1.style.display = "none";
    el2.style.display = "block";
}

var CurrentID = null;

function GetCurrentEditingID(){
    return CurrentID;
}

function EditReservation(id, name, contact, n_people, entrance_time, username) {
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


    var reservationData = JSON.stringify({"id": id, "name": name, "contact": contact, "n_people": n_people, "entrance_time": entrance_time, "username": username});
    console.log(reservationData);
    $.ajax({
        url: "php/editreservation.php",
        type: "POST",
        dataType: "json",
        data: {
            reservationData: reservationData
        },
        success: function () {
            document.getElementById("form").style.display = "none";
            document.getElementById("success").style.display = "block";
        },
        error: function (data) {
            console.log(data.responseText);
            document.getElementById("form").style.display = "none";
            document.getElementById("error").style.display = "block";
        }
    });
    console.log("Name: " + name + "\n Contact: " + contact + "\n People: " + n_people + "\n Entrance Time: " + entrance_time)
}

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        );
};

function BackToForm(){
    document.getElementById('tbcontainer').style.display = "none";
    document.getElementById('container').style.display = "block";
}