const labels = [
    'Lunedì',
    'Martedì',
    'Mercoledì',
    'Giovedì',
    'Venerdì',
    'Sabato',
    'Domenica'
];

var chart = null;
var lastDate = null;

function ShowChart(date) {

    if(lastDate != null){
    var lastFirstDay = new Date(lastDate.setDate(lastDate.getDate() - lastDate.getDay()));
    var lastLastDay = new Date(lastDate.setDate(lastDate.getDate() - lastDate.getDay() + 6));
    }

    var firstDay = new Date(date.setDate(date.getDate() - date.getDay()));
    var lastDay = new Date(date.setDate(date.getDate() - date.getDay() + 6));

    //console.log("lastFirstDay: " + lastFirstDay + "; lastLastDay: " + lastLastDay + "; firstDay: " + firstDay + "; lastDay: " + lastDay + "; ")
    if(lastDate != null){
        if(lastFirstDay.getDate() == firstDay.getDate() && lastLastDay.getDate() == lastDay.getDate()){
            return;
        }
    }

    var affluence = null;

    $.ajax({
        url: "php/affluence.php",
        type: "POST",
        dataType: "json",
        data: {
            data: JSON.stringify({ "firstDay": firstDay, "lastDay": lastDay })
        },
        success: function (data) {
            affluence = data;
            console.log(affluence);

            const chartData = {
                labels: labels,
                datasets: [{
                    label: 'Affluenza settimanale',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: affluence,
                }]
            };
        
            const config = {
                type: 'line',
                data: chartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };
        
        
            if (document.getElementById("chart").ariaChecked == "true") {
                chart.config.data = chartData;
                chart.update();
            }
            else {
                chart = new Chart(
                    document.getElementById('chart'),
                    config
                );
        
                document.getElementById("chart").ariaChecked = "true";
            }

            lastDate = date;
        },
        error: function (data) {
            alert(data.responseText);
        }
    });

    
}
