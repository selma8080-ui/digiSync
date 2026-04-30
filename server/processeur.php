<div id="cpuChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
    let cpuHistory = [];

function BuildCpuChart(data) {

    var cpuChart = document.getElementById('cpuChart');
    var myChart = echarts.init(cpuChart);

    let now = new Date();

    // 🔥 accumulate history (NOT reset)
    cpuHistory.push([now, data.cpuUsed]);

    if (cpuHistory.length > 15) {
        cpuHistory.shift();
    }

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
                    return String(d.getHours()).padStart(2, '0') + ':' +
                           String(d.getMinutes()).padStart(2, '0');
                }
            }
        },

        yAxis: {
            type: 'value',
            max: 100,
            axisLabel: { formatter: '{value} %' }
        },

        series: [{
            name: 'CPU',
            type: 'line',
            smooth: true,
            symbol: 'none',
            areaStyle: {},
            data: cpuHistory
        }]
    };

    myChart.setOption(option);
}


</script>