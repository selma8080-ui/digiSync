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
    
    let data = [];
    let maxDuration = 6 * 3600 * 1000; 

    var option = {
        tooltip: { trigger: 'axis', position: function (pt) { return [pt[0], '10%']; } },
        title: { left: 'center', text: 'Traffic Reseau' },
        toolbox: { feature: { saveAsImage: {} } },
        xAxis: {
            type: 'time',
            min: function (value) { return value.max - (6 * 3600 * 1000); },
            max: function (value) { return value.max; },
            axisLabel: { formatter: function (value) {
                let d = new Date(value);
                return d.getHours() + ':' + String(d.getMinutes()).padStart(2, '0');
            } }
        },
        yAxis: { type: 'value', axisLabel: { formatter: function (value) {
            return (value / (1024 * 1024)).toFixed(2) + ' MB';
        } } },
        series: [{ name: 'Utilisation Reseau', type: 'line', smooth: true, symbol: 'none', areaStyle: {}, data: data }]
    };

    myChart.setOption(option);


    function addDataPoint(value) {
        let now = new Date().getTime();
        data.push([now, value]);
        data = data.filter(point => now - point[0] <= maxDuration);
        myChart.setOption({ series: [{ data: data }] });
    }


    let now = new Date().getTime();
    for (let i = 0; i < 100; i++) {
        let time = now - (100 - i) * (6 * 3600 * 1000 / 100);
        let value = Math.random() * 50 * 1024 * 1024;
        data.push([time, value]);
    }
    myChart.setOption({ series: [{ data: data }] });

</script>

</body>
</html>