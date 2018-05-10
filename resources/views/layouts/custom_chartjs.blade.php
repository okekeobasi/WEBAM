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
        if(type == "line"){
            var config = {
                type: type,
                data: {
                    datasets: [
                        {
                            label: 'Attendance',
                            backgroundColor     : '#839dbc',
                            data: time,
                        }
                    ],
                    labels: date
                }
            }
        }else {
            var config = {
                type: type,
                data: {
                    datasets: [
                        {
                             label: 'Attendance',
                             data: time,
                             backgroundColor: [
                                 '#9c8b3a',
                                 '#800ff5',
                                 '#f5481d',
                                 '#d2f8a2',
                                 '#f54061',
                                 '#0df527',
                                 '#c4adf5',
                                 '#f56954',
                                 '#00a65a',
                                 '#f39c12',
                                 '#00c0ef',
                                 '#3c8dbc',
                                 '#d2d6de',
                             ],
                        }
                    ],
                    labels: date
                }
            }
        }
        return config;
}

function resetCanvas(){
    $('#canvas').remove(); // this is my <canvas> element
    $('#graph-container').append('<canvas id="canvas"><canvas>');
}
</script>