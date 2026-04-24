<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>
    <title>Document</title>
</head>
<body>

    <div id="chart" style="width:600px;height:400px;"></div>

    <script>
        var chartDom = document.getElementById('chart');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
        series: [
            {
            type: 'gauge',
            axisLine: {
                lineStyle: {
                width: 30,
                color: [
                    [0.3, '#67e0e3'],
                    [0.7, '#37a2da'],
                    [1, '#fd666d']
                ]
                }
            },
            pointer: {
                itemStyle: {
                color: 'auto'
                }
            },
            axisTick: {
                distance: -30,
                length: 8,
                lineStyle: {
                color: '#fff',
                width: 2
                }
            },
            splitLine: {
                distance: -30,
                length: 30,
                lineStyle: {
                color: '#fff',
                width: 4
                }
            },
            axisLabel: {
                color: 'inherit',
                distance: 40,
                fontSize: 20
            },
            detail: {
                valueAnimation: true,
                formatter: '{value} km/h',
                color: 'inherit'
            },
            data: []
            }
        ]
        };

        option && myChart.setOption(option);

    </script>
</body>
</html>