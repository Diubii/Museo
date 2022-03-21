function FindReservation(){

    let id = $('#inputID').val();

    console.log(id.length);
    if(id == "" || id.length > 5 || id.length < 1){
        document.getElementById("NotValidID").style.display = "block";
        return;
    }

    var data = JSON.stringify({"id": id});
    console.log(data);
    while (document.getElementById("tBody").firstChild) {
        document.getElementById("tBody").firstChild.remove();
      }
    $.ajax({
        url: "php/findreservation.php",
        type: "POST",
        dataType: "json",
        data: {
            id: data
        },
        success: function (data) {
            console.log(data);
            var tr = document.createElement('tr');
            tr.id = data[0];
            data.forEach(element => {
                var td = document.createElement('td');
                td.textContent = element;
                tr.appendChild(td);
            });

            if(data.length > 1){
            var td = document.createElement('td');
            var a = document.createElement('a');
            a.onclick = function(){ShowEditReservation(data[0], document.getElementById('tbcontainer'), document.getElementById('form'))};
            var i = document.createElement('i');
            i.classList.add("fa-solid", "fa-pen-to-square");
            a.appendChild(i);
            td.appendChild(a);
            tr.appendChild(td);

            var td = document.createElement('td');
            var a = document.createElement('a');
            a.onclick = function(){DeleteReservation(data[0], location.href)};
            var i = document.createElement('i');
            i.classList.add("fa-solid", "fa-trash");
            a.appendChild(i);
            td.appendChild(a);
            tr.appendChild(td);
            }

            var td = document.createElement('td');
            var a = document.createElement('a');
            a.onclick = function(){BackToForm()};
            var i = document.createElement('i');
            i.classList.add("fa-solid", "fa-backward-step");
            a.appendChild(i);
            td.appendChild(a);
            tr.appendChild(td);
                
            document.getElementById("tBody").appendChild(tr);
            document.getElementById("tbcontainer").style.display = "block";
            document.getElementById("container").style.display = "none";
        },
        error: function (data) {
            console.log(data.responseText);
            document.getElementById("form").style.display = "none";
            document.getElementById("error").style.display = "block";
        }
    });
}