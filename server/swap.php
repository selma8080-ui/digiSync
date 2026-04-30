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
                    length: 15,
                    lineStyle: {
                        width: 2,
                        color: '#999'
                    }
                },
                axisLabel: {
                    distance: 25,
                    color: '#999',
                    fontSize: 12
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
                    fontSize: 30,
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

    // 🔥 mise à jour toutes les 2s (simulation)
    setInterval(() => {
        let newValue = Math.round(Math.random() * 100);

        myChart.setOption({
            series: [{
                data: [{ value: newValue }]
            }]
        });

    }, 2000);
}

// 🔥 IMPORTANT : appel
BuildSwapChart(50);
</script>