function reservate(name, contact, n_people, entrance_time){
    const xmlHttp = new XMLHttpRequest();
    xmlHttp.onload = function(){
        document.getElementById("form").style.display="none";
        document.getElementById("success").style.display="block";
    }
    xmlHttp.open("POST", "php/prenota.php?n=" + name + "&c=" + contact + "&np=" + n_people + "&e=" + entrance_time);
    xmlHttp.send();
}