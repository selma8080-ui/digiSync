<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>

</head>
<body>
    <div id="trafficDisqueChart" style="width:100%; height:300px;"></div>

    <script>
        var trafficDisqueChart = document.getElementById('trafficDisqueChart');
        var myChart = echarts.init(trafficDisqueChart);
        var option;

        let base = +new Date(1988, 9, 3);
        let oneDay = 24 * 3600 * 1000;
        let data = [];
        let maxDuration = 6 * 3600 * 1000; 

        function addDataPoint(value) {
            let now = new Date().getTime();

            data.push([now, value]);


            data = data.filter(point => now - point[0] <= maxDuration);

            myChart.setOption({
                series: [{
                    data: data
                }]
            });
        };
        option = {
    tooltip: {
        trigger: 'axis',
        position: function (pt) {
            return [pt[0], '10%'];
        }
    },
    title: {
        left: 'center',
        text: 'Traffic Disque'
    },
    toolbox: {
        feature: {
            saveAsImage: {} 
        }
    },
    xAxis: {
        type: 'time',
        min: function (value) {
            return value.max - (6 * 3600 * 1000);
        },
        max: function (value) {
            return value.max;
        },
        axisLabel: {
            formatter: function (value) {
                let d = new Date(value);
                return d.getHours() + ':' + String(d.getMinutes()).padStart(2, '0');
            }
        }
    },
    yAxis: {
        type: 'value',
        axisLabel: {
            formatter: function (value) {
                return (value / (1024 * 1024)).toFixed(2) + ' MB';
            }
        }
    },
    series: [
        {
            name: 'Utilisation Disque',
            type: 'line',
            smooth: true,
            symbol: 'none',
            areaStyle: {},
            data: data
        }
    ]
};

        let now = new Date().getTime();

for (let i = 0; i < 100; i++) {
    let time = now - (100 - i) * (6 * 3600 * 1000 / 100); 
    let value = Math.random() * 50 * 1024 * 1024; 
    data.push([time, value]);
}

        option && myChart.setOption(option);

    </script>

</body>
</html>