<div id="cpuChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function BuildCpuChart() {

    var cpuChart = document.getElementById('cpuChart');
    var myChart = echarts.init(cpuChart);

    let data = [];
    let maxDuration = 60 * 1000; 

    var option = {
        
        title: {
            text: 'CPU Usage',
            left: 'center'
        },

        tooltip: {
            trigger: 'axis'
        },

        xAxis: {
            type: 'time',

            axisLabel: {
                formatter: function (value) {
                    let d = new Date(value);
                    return d.getHours() + ':' + String(d.getMinutes()).padStart(2, '0');
                },

                hideOverlap: true   
            }
        },

        yAxis: {
            type: 'value',
            max: 100,
            axisLabel: {
                formatter: '{value} %'
            }
        },

        series: [{
            name: 'CPU',
            type: 'line',
            smooth: true,
            symbol: 'none',
            areaStyle: {},
            data: data,
            lineStyle: {
                color: '#fff',
                width: 4
            },
            itemStyle: {
                color: '#91cc75'  
            }
        }]
    };

    myChart.setOption(option);

    function addData(value) {
        let now = new Date().getTime();

        data.push([now, value]);

        data = data.filter(point => now - point[0] <= maxDuration);

        myChart.setOption({
            series: [{
                data: data
            }]
        });
    }

    setInterval(() => {
        let cpuValue = Math.round(Math.random() * 100);
        addData(cpuValue);
    }, 2000);
}

BuildCpuChart();
</script>