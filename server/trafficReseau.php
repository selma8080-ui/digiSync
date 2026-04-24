<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>

</head>
<body>
    <div id="trafficReseauChart" style="width:100%; height:300px;"></div>

    <script>
        var trafficReseauChart = document.getElementById('trafficReseauChart');
        var myChart = echarts.init(trafficReseauChart);
        var option;

        let baseR = +new Date(1988, 9, 3);
        let oneDayR = 24 * 3600 * 1000;
        let dataR = [[baseR, Math.random() * 300]];
        for (let i = 1; i < 20000; i++) {
        let now = new Date((baseR += oneDayR));
        dataR.push([+now, Math.round((Math.random() - 0.5) * 20 + dataR[i - 1][1])]);
        }
        option = {
        tooltip: {
            trigger: 'axis',
            position: function (pt) {
            return [pt[0], '10%'];
            }
        },
        title: {
            left: 'center',
            text: 'Large Ara Chart'
        },
        toolbox: {
            feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            restore: {},
            saveAsImage: {}
            }
        },
        xAxis: {
            type: 'time',
            boundaryGap: false
        },
        yAxis: {
            type: 'value',
            boundaryGap: [0, '100%']
        },
        dataZoom: [
            {
            type: 'inside',
            start: 0,
            end: 20
            },
            {
            start: 0,
            end: 20
            }
        ],
        series: [
            {
            name: 'Fake Data',
            type: 'line',
            smooth: true,
            symbol: 'none',
            areaStyle: {},
            data: dataR
            }
        ]
        };

        option && myChart.setOption(option);

    </script>

</body>
</html>