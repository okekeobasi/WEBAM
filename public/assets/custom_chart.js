$(document).ready(
function () {
    // var chart_type = changeFunc();
    var chart_type = document.getElementById("chart").value
    getLink(chart_type)
});

function changeFunc() {
    var selectBox = document.getElementById("chart");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var chart_type = selectedValue;
    resetCanvas()
    getLink(chart_type)
 }

function getLink(chart_type){
    var myChart = new Chart(document.getElementById("canvas").getContext("2d"), getChartJs(chart_type));
    canvas = document.getElementById("canvas")
    canvas.onclick = function(evt) {
        console.log("Hello")
        // getLink(myChart, evt)
        var activePoints = myChart.getElementsAtEvent(evt)
        if (activePoints[0]) {
            var chartData = activePoints[0]['_chart'].config.data;
            var idx = activePoints[0]['_index'];

            var label = chartData.labels[idx];
            var value = chartData.datasets[0].data[idx];

            var url = "file:///C:/xampp/htdocs/WEBAM/chart.html?label=" + label + "&value=" + value;
            window.open(url,"_self");
            // window.location.replace(url);
            console.log(url);
      }
  }
}

function getChartJs(type) {
    if(type == "Pie"){
        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [225, 50, 100, 40],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(139, 195, 74)"
                    ],
                }],
                labels: [
                    "Pink",
                    "Amber",
                    "Cyan",
                    "Light Green"
                ]
            }
        }
    }

    else if(type == "Bar"){
        var config = {
            type: 'bar',
            data: {
                datasets: [{
                    data: [225, 50, 100, 40],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(139, 195, 74)"
                    ],
                }],
                labels: [
                    "Pink",
                    "Amber",
                    "Cyan",
                    "Light Green"
                ]
            }
        }
    }

    else if(type == "Line"){
        var config = {
            type: 'line',
            data: {
                datasets: [{
                    data: [225, 50, 100, 40],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(139, 195, 74)"
                    ],
                }],
                labels: [
                    "Pink",
                    "Amber",
                    "Cyan",
                    "Light Green"
                ]
            }
        }
    }

    else if(type == "Radar"){
        var config = {
            type: 'radar',
            data: {
                datasets: [{
                    data: [225, 50, 100, 40],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(139, 195, 74)"
                    ],
                }],
                labels: [
                    "Pink",
                    "Amber",
                    "Cyan",
                    "Light Green"
                ]
            }
        }
    }

    else if(type == "Doughnut"){
        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [225, 50, 100, 40],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(139, 195, 74)"
                    ],
                }],
                labels: [
                    "Pink",
                    "Amber",
                    "Cyan",
                    "Light Green"
                ]
            }
        }
    }
    return config;
}

function resetCanvas(){
    $('#canvas').remove(); // this is my <canvas> element
    $('#graph-container').append('<canvas id="canvas"><canvas>');
}