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
                                 '#9c8b3a', '#800ff5',
                                 '#f5481d', '#d2f8a2',
                                 '#f54061', '#0df527',
                                 '#c4adf5', '#f56954',
                                 '#00a65a', '#f39c12',
                                 '#00c0ef', '#3c8dbc',
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

function export_chart() {
    var url_base64jp = document.getElementById("canvas").toDataURL("image/jpg");
    window.open(url_base64jp);
}

function parseChart() {
    var text = $('#daterange-btn').text().trim();
    text = text.split('-')
    console.log(text);
    startDate = text[0].trim();
    endDate = text[1].trim();

    var d = new Date(startDate)
    startDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    d = new Date(endDate)
    endDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();

    console.log(startDate, endDate)
    var url = '{{route('api.dashboard')}}/' + startDate + ',' + endDate + '';
    var new_date = [];
    var new_time_in = [];
    var new_time_out = [];
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            _method: 'GET',
            startDate: startDate,
            endDate: endDate,
            _token: '{{csrf_token()}}',
            link: '{{url()->current()}}',
            id: '{{$user->staffId or 0}}'
        },
        success: function (data) {
            console.log(url);
            console.log(data);
            for(i=0; i<data.length; i++){
                new_date.push(data[i].date);
                t = new_date[i] + "T" + data[i].time_in;
                time_ = new Date(t);
                new_time_in.push(time_.getHours());
                t = new_date[i] + "T" + data[i].time_out;
                time_ = new Date(t);
                new_time_out.push(time_.getHours());
            }
            console.log(new_date, new_time_in, new_time_out);
            date_array = new_date.slice();
            time_in_array = new_time_in.slice();
            time_out_array = new_time_out.slice();
            generalTime = time_in_array.slice();

            resetCanvas();
            var myChart = new Chart(document.getElementById("canvas").getContext("2d"), getChartJs(chart_type, date_array, generalTime));
        },
        dataType: 'json'
    });

    console.log(date_array, time_in_array, generalTime);
}
</script>