<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
</head>
<body>
    
    <div id="disqueChart" style="width:100%; height:300px;""></div>

    <script>
        var disqueChart = document.getElementById('disqueChart');
        var myChart = echarts.init(disqueChart);
        var option;

        option = {
        title: {
            left: 'center'
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            left: 'left'
        },
        series: [
            {
            name: 'Access From',
            type: 'pie',
            radius: '50%',
            data: [],
            emphasis: {
                itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
            }
        ]
        };

        option && myChart.setOption(option);


    </script>
</body>
</html>