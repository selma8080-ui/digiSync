<div id="ramChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function buildRamChart(value) {

    var ramChart = document.getElementById('ramChart');
    var myChart = echarts.init(ramChart);

    var option = {
        title: {
            text: 'RAM Usage',
            left: 'center'
        },

        series: [
            {
                type: 'gauge',

                axisLine: {
                    lineStyle: {
                        width: 20,
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
                    distance: -10,
                    length: 10,
                    lineStyle: {
                        color: '#fff',
                        width: 2
                    }
                },

                splitLine: {
                    distance: -35,
                    length: 25,
                    lineStyle: {
                        color: '#fff',
                        width: 4
                    }
                },

                axisLabel: {
                    color: 'inherit',
                    distance: 40,
                    fontSize: 13
                },

                detail: {
                    valueAnimation: true,
                    formatter: '{value} %',
                    color: 'inherit',
                    fontSize: 25
                },

                data: [{ value: value }]
            }
        ]
    };

    myChart.setOption(option);

    setInterval(() => {
        let newValue = Math.round(Math.random() * 100);

        myChart.setOption({
            series: [{
                data: [{ value: newValue }]
            }]
        });

    }, 2000);
}

// 🔥 TEST
buildRamChart(50);
</script>