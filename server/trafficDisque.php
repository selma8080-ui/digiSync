<div id="trafficDisqueChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function BuildRamChart(data) {
    var chartDom = document.getElementById('trafficDisqueChart');
    var myChart = echarts.init(chartDom);

    let dataD = data;
    let maxDuration = 6 * 3600 * 1000;

    function getNow() {
        return new Date().getTime();
    }

    var option = {
        tooltip: { trigger: 'axis' },
        title: { left: 'center', text: 'Traffic Disque' },

        xAxis: {
            type: 'time',
            min: getNow() - maxDuration,
            max: getNow(),
            axisLabel: {
                formatter: function (value) {
                    let d = new Date(value);
                    return d.getHours() + ':' + String(d.getMinutes()).padStart(2, '0');
                },
                hideOverlap: true
            },
            splitNumber: 6,
            splitLine: { show: false }
        },

        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: v => (v / (1024 * 1024)).toFixed(2) + ' MB'
            }
        },

        series: [{
            name: 'Utilisation Disque',
            type: 'line',
            smooth: true,
            symbol: 'none',
            lineStyle: { color: '#5470c6', width: 2 },
            areaStyle: { color: 'rgba(84, 112, 198, 0.3)' },
            data: dataD
        }]
    };

    myChart.setOption(option);

    function addDataPoint(value) {
        let now = getNow();

        dataD.push([now, value]);


        dataD = dataD.filter(p => now - p[0] <= maxDuration);

        myChart.setOption({
            xAxis: {
                min: now - maxDuration,
                max: now
            },
            series: [{ data: dataD }]
        });
    }

    let now = getNow();
    for (let i = 0; i < 100; i++) {
        dataD.push([
            now - (6 * 3600 * 1000) + i * 360000, // espacé sur 6h
            Math.random() * 50 * 1024 * 1024
        ]);
    }

    myChart.setOption({
        series: [{ data: dataD }],
        xAxis: {
            min: now - maxDuration,
            max: now
        }
    });

    setInterval(() => {
        addDataPoint(Math.random() * 50 * 1024 * 1024);
    }, 2000);
}

BuildRamChart([]);
</script>