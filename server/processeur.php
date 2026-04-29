    <div id="cpuChart" style="width:100%; height:300px;"></div>

    <script>
        function BluidCpuChart(data) {
            var cpuChart = document.getElementById('cpuChart');
            var myChart = echarts.init(cpuChart);
            var option;

            option = {
            xAxis: {
                type: 'category',
                data: data
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                data: data,
                type: 'line',
                smooth: true,
                areaStyle: {}
                }
            ]
            };

            option && myChart.setOption(option);
        }
    </script>
