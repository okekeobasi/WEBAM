<script>
    var url = '';
    var date_array = [];
    var time_in_array = [];
    var time_out_array = [];
    var generalTime = [];
    chart_type = 'line';
    timeType = 'In';
    limit = 'all';
    var startDate = '';
    var endDate = '';

    $(document).ready(
        function () {
            url = '{{route('api.employee.report')}}';
        }
    );

    function setChartType(id){

        openChart(id)
    }

    function setTimeType(id){

        openChart(id)
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
    
    function openChart(id) {
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

                resetCanvas(id);
                canvas = 'canvas' + id + '';
                console.log(canvas);
                console.log(document.getElementById(canvas));

                time_name = '#time' + id
                timeType = $(time_name).find(':selected').val();

                chart_name = '#chart' + id;
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
        console.log("hello");
    }

    function resetCanvas(id){
        canvas = '#canvas' + id + '';
//        console.log($(canvas));
        container = '#graph-container' + id
        canvasHTML = '<canvas id="canvas' + id + '"></canvas>';
        console.log(canvasHTML, canvas, container);
        $(canvas).remove(); // this is my <canvas> element
        $(container).append(canvasHTML);

    }

    function export_chart(id) {
        canvas = 'canvas' + id + '';
        var url_base64jp = document.getElementById(canvas).toDataURL("image/jpg");
        window.open(url_base64jp);
    }
</script>

<script>
    @foreach($users as $user)
        $('#daterange-btn{{$user->staffId}}').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Last 3 Months'  : [moment().subtract(3, 'month'), moment()],
                    'Last 6 Months'  : [moment().subtract(6, 'month').startOf('month'), moment()],
                    '1 year'  : [moment().subtract(12, 'month').startOf('month'), moment()]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn{{$user->staffId}} span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                parseChart();
            }
        );
    @endforeach
</script>