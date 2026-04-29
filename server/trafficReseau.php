
    <div id="trafficReseauChart" style="width:100%; height:300px;"></div>

    <script>
        function BluidRamChart(data) {
            var trafficReseauChart = document.getElementById('trafficReseauChart');
            var myChartR = echarts.init(trafficReseauChart);


            let dataR = data;
            let maxDurationR = 6 * 3600 * 1000;

            var optionR = {
                tooltip: { trigger: 'axis' },
                title: { left: 'center', text: 'Traffic Réseau' },
                xAxis: {
                    type: 'time'
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        formatter: v => (v / (1024 * 1024)).toFixed(2) + ' MB'
                    }
                },
                series: [{
                    name: 'Réseau',
                    type: 'line',
                    smooth: true,
                    symbol: 'none',
                    areaStyle: {},
                    data: dataR
                }]
            };

            myChartR.setOption(optionR);


            function addDataPointR(value) {
                let nowR = new Date().getTime();

                dataR.push([nowR, value]);

                dataR = dataR.filter(point => nowR - point[0] <= maxDurationR);

                myChartR.setOption({
                    series: [{
                        data: dataR
                    }]
                });
            }

            let nowR = new Date().getTime();

            for (let i = 0; i < 100; i++) {
                let timeR = nowR - (100 - i) * (6 * 3600 * 1000 / 100);
                let valueR = Math.random() * 50 * 1024 * 1024;
                dataR.push([timeR, valueR]);
            }

            myChartR.setOption({ series: [{ data: dataR }] });
        }
    </script>
