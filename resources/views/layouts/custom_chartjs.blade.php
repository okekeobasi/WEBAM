<script>
var date_array = @php(print_r($date_array));
var time_in_array = @php(print_r($time_in_array));
var time_out_array = @php(print_r($time_out_array));
var generalTime = time_in_array;

var jsTime = [];
var chart_type = "";
$(document).ready(
function () {
    chart_type = $('#chart').find(':selected').val();
    generalTime = time_in_array;
    var myChart = new Chart(document.getElementById("canvas").getContext("2d"), getChartJs(chart_type, date_array, generalTime));
});

function setChartType(){
    chart_type = $('#chart').find(':selected').val();
    // generalTime = time_in_array;
    console.log(date_array, generalTime);
    resetCanvas();
    var myChart = new Chart(document.getElementById("canvas").getContext("2d"), getChartJs(chart_type, date_array, generalTime));
}

function setTimeType(){
    timeType = $('#time').find(':selected').val();
    console.log(date_array, time_out_array)
    resetCanvas();
    
    if(timeType == "Out") generalTime = time_out_array;
    else generalTime = time_in_array;

    var myChart = new Chart(document.getElementById("canvas").getContext("2d"), getChartJs(chart_type, date_array, generalTime));
}

function getChartJs(type, date, time) {

        var config = {
            type: type,
            data: {
                datasets: [
                    {
                        label: 'Attendance',
                        data: time,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                    }
                ],
                
                labels: date
            }
        }
        return config;
}

function resetCanvas(){
    $('#canvas').remove(); // this is my <canvas> element
    $('#graph-container').append('<canvas id="canvas"><canvas>');
}
</script>