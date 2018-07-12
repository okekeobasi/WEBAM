<script>
    url = '{{route('api.config.department')}}';
    var date_array = [];
    var time_in_array = [];
    var time_out_array = [];
    var generalTime = [];
    chart_type = 'line';
    timeType = 'In';
    limit = 'all';
    var startDate = '';
    var endDate = '';
    var id = '{{$id}}';
    var colourList = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        '#c4adf5', '#f56954',
        '#dcc0df', '#dc8ddc',
        '#cdafff', '#feedcf'
    ];
    var colourIndex = 0;

    lineArray = [];

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

        dataset = [
            {
                label: 'Christophero',
                data: time,
            },
            {
                label: 'chidozieo',
                data: [
                    10,7,7,8,11,12,
                    10,8,9,8,8,6,
                    7,10,11,9,8
                ]
            }
        ];
        console.log(lineArray, "lineArray");


        if(type == "line"){
            var config = {
                type: type,
                data: {
                    datasets: lineArray,
                    labels: date
                },
            }
        }else {
            var config = {
                type: type,
                data: {
                    datasets: lineArray,
                    labels: date
                }
            }
        }
        return config;
    }



    function openChart() {
        lineArray = [];
        var date_checker = '';
        var date_checker_counter = 0;

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
            success: function(item){

                object = item[0];
                users = item[1];

                var new_date = [];
                var new_time_in = [];
                var new_time_out = [];

                for(z=0; z<object.length; z++){
                    new_date.push(object[z].date);
                }
//                console.log(new_date);
                if(limit != 'all') console.log(users);
                for(i=0; i<users.length; i++){
                    dataset = {};
                    dataset.label = '';
                    dataset.data = [];
                    dataset.backgroundColor = colourList[getRandomInt(colourList.length)];
                    new_time_in = [];
                    new_time_out = [];


                    dataset.label = users[i].username;
                    for(j=0; j<object.length; j++){
                        if(users[i].staffId == object[j].user_id){
                            t = new_date[j] + "T" + object[j].time_in;
                            time_ = new Date(t);
                            new_time_in.push(time_.getHours());
                            t = new_date[j] + "T" + object[j].time_out;
                            time_ = new Date(t);
                            new_time_out.push(time_.getHours());
                        }
                    }

                    timeType = $("#time").find(':selected').val();
                    if(timeType == 'In') dataset.data = new_time_in.slice();
                    if(timeType == 'Out') dataset.data = new_time_out.slice();

//                    lineChartData.datasets.push(dataset);
                    lineArray.push(dataset);
                    colourIndex++;
                    console.log(startDate, endDate);
                }

                date_array = new_date.slice();

                resetCanvas();
                canvas = 'canvas';


                chart_name = '#chart';
                chart_type = $(chart_name).find(':selected').val();

                var myChart = new Chart(document.getElementById(canvas).getContext("2d"), getChartJs(chart_type, new_date, new_time_in));
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
//        console.log("dates: " , text);
        startDate = text[0].trim();
        endDate = text[1].trim();

        var d = new Date(startDate)
        startDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
        d = new Date(endDate)
        endDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();

        limit = '';
        openChart()
    }

    function resetCanvas(id){
        canvas = '#canvas';
//        console.log($(canvas));
        container = '#graph-container';
        canvasHTML = '<canvas id="canvas"></canvas>';
//        console.log(canvasHTML, canvas, container);
        $(canvas).remove(); // this is my <canvas> element
        $(container).append(canvasHTML);

    }

    function export_chart(id) {
        canvas = 'canvas';
        var url_base64jp = document.getElementById(canvas).toDataURL("image/jpg");
        window.open(url_base64jp);
    }

    function getRandomInt(max) {
        return Math.floor(Math.random() * Math.floor(max));
    }

</script>

