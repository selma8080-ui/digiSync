<div id="trafficReseauChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function BuildReseauChart(data) {
    var chartDom = document.getElementById('trafficReseauChart');
    var myChartR = echarts.init(chartDom);

    let dataR = data;
    let maxDurationR = 6 * 3600 * 1000;

    function getNow() {
        return new Date().getTime();
    }

    var optionR = {
        tooltip: { trigger: 'axis' },
        title: { left: 'center', text: 'Traffic Réseau' },

        xAxis: {
            type: 'time',
            min: getNow() - maxDurationR,
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
            name: 'Réseau',
            type: 'line',
            smooth: true,
            symbol: 'none',
            lineStyle: { color: '#5470c6', width: 2 },
            areaStyle: { color: 'rgba(84, 112, 198, 0.3)' },
            data: dataR
        }]
    };

    myChartR.setOption(optionR);

    function addDataPointR(value) {
        let now = getNow();

        dataR.push([now, value]);

        dataR = dataR.filter(p => now - p[0] <= maxDurationR);

        myChartR.setOption({
            xAxis: {
                min: now - maxDurationR,
                max: now
            },
            series: [{ data: dataR }]
        });
    }

    // init 6h propre
    let now = getNow();
    for (let i = 0; i < 100; i++) {
        dataR.push([
            now - (6 * 3600 * 1000) + i * 360000,
            Math.random() * 50 * 1024 * 1024
        ]);
    }

    myChartR.setOption({
        series: [{ data: dataR }],
        xAxis: {
            min: now - maxDurationR,
            max: now
        }
    });

    setInterval(() => {
        addDataPointR(Math.random() * 50 * 1024 * 1024);
    }, 2000);
}

BuildReseauChart([]);
</script>