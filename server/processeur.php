<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>
</head>

<body>

    <div id="cpuChart" style="width:100%; height:300px;"></div>

    <script>
        var cpuChart = document.getElementById('cpuChart');
        var myChart = echarts.init(cpuChart);
        var option;

        option = {
        xAxis: {
            type: 'category',
            data: []
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
            data: [],
            type: 'line',
            smooth: true,
            areaStyle: {}
            }
        ]
        };

        option && myChart.setOption(option);
    </script>

</body>
</html>

