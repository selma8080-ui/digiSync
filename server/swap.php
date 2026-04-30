<div id="swapChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function BuildSwapChart(value) {

    var swapChart = document.getElementById('swapChart');
    var myChart = echarts.init(swapChart);

    var option = {
         title: {
            text: 'SWAP Usage',
            left: 'center'
        },
        series: [
            {
                type: 'gauge',
                progress: {
                    show: true,
                    width: 18
                },
                axisLine: {
                    lineStyle: {
                        width: 18
                    }
                },
                axisTick: { show: false },
                splitLine: {
                    length: 3,
                    lineStyle: {
                        width: 2,
                        color: '#999'
                    }
                },
                axisLabel: {
                    distance: 25,
                    color: '#999',
                    fontSize: 14
                },
                anchor: {
                    show: true,
                    size: 20,
                    itemStyle: {
                        borderWidth: 5
                    }
                },
                title: { show: false },
                detail: {
                    valueAnimation: true,
                    fontSize: 20,
                    formatter: '{value} %'
                },
                data: [
                    {
                        value: value
                    }
                ]
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

BuildSwapChart(50);
</script>