<script>
    var url = '{{route('api.employee.log')}}';
    var date_array = [];
    var time_in_array = [];
    var time_out_array = [];
    var generalTime = [];
    var chart_type = 'line';
    var timeType = 'In';
    var limit = 'all';
    var startDate = '';
    var endDate = '';
    var id = {{$id}}

    $(document).ready(
        function () {
            openChart();
        }
    );

    function setChartType(){

        openChart()
    }

    function setTimeType(){

        openChart()
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

    function openChart() {
        $.ajax({
            url: url,
            type: 'GET',
            data:{
                _method: 'GET',
                _token: '{{csrf_token()}}',
                id: id,
                limit: limit,
                startDate: startDate,
                endDate: endDate
            },
            success: function(object){
                var new_date = [];
                var new_time_in = [];
                var new_time_out = [];

                for(i=0; i<object.length; i++){
                    new_date.push(object[i].date);
                    t = new_date[i] + "T" + object[i].time_in;
                    time_ = new Date(t);
                    new_time_in.push(time_.getHours());
                    t = new_date[i] + "T" + object[i].time_out;
                    time_ = new Date(t);
                    new_time_out.push(time_.getHours());
                }

                date_array = new_date.slice();
                time_in_array = new_time_in.slice();
                time_out_array = new_time_out.slice();
                generalTime = time_in_array.slice();

                resetCanvas();
                canvas = 'canvas';
                console.log(canvas);
                console.log(document.getElementById(canvas));

                time_name = '#time'
                timeType = $(time_name).find(':selected').val();

                chart_name = '#chart'
                chart_type = $(chart_name).find(':selected').val();

                if(timeType == 'In') var myChart = new Chart(document.getElementById(canvas).getContext("2d"), getChartJs(chart_type, new_date, new_time_in));
                if(timeType == 'Out') var myChart = new Chart(document.getElementById(canvas).getContext("2d"), getChartJs(chart_type, new_date, new_time_out))
            },
            dataType: 'json'
        });
    };

    function plotChart(object, id) {
        //
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

        limit = '';
        openChart()
    }

    function resetCanvas(){
        canvas = '#canvas';
//        console.log($(canvas));
        container = '#graph-container'
        canvasHTML = '<canvas id="canvas"></canvas>';
        console.log(canvasHTML, canvas, container);
        $(canvas).remove(); // this is my <canvas> element
        $(container).append(canvasHTML);

    }

    function export_chart(id) {
        canvas = 'canvas';
        var url_base64jp = document.getElementById(canvas).toDataURL("image/jpg");
        window.open(url_base64jp);
    }
</script>
