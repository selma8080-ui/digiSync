    <div id="disqueChart"  style="width:100%; height:300px;"></div>

    <script>
        function BuildDisqueChart(data) {
            var disqueChart = document.getElementById('disqueChart');
            var myChart = echarts.init(disqueChart);
            var option;

            option = {
            title: {
                text: 'Disque Usage',
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
                data: data,
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
        }

    </script>