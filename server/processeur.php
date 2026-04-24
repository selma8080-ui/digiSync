<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>
</head>

<body>

    <div id="chart" style="width: 250px;height: 250px;"></div>

    <script>
        
        var chartDom = document.getElementById('chart');
        var myChart = echarts.init(chartDom);
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

