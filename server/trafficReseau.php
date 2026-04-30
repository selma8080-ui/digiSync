<div id="trafficReseauChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function BuildReseauChart(data) {

    var trafficReseauChart = document.getElementById('trafficReseauChart');
    var myChartR = echarts.init(trafficReseauChart);

    let dataR = data;
    let maxDurationR = 6 * 3600 * 1000;

    var optionR = {
        tooltip: { trigger: 'axis' },
        title: { left: 'center', text: 'Traffic Réseau' },
        xAxis: { type: 'time' },
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

        // garder seulement 6h
        dataR = dataR.filter(point => nowR - point[0] <= maxDurationR);

        myChartR.setOption({
            series: [{
                data: dataR
            }]
        });
    }

    // données initiales
    let nowR = new Date().getTime();

    for (let i = 0; i < 50; i++) {
        let timeR = nowR - (50 - i) * 2000;
        let valueR = Math.random() * 50 * 1024 * 1024;
        dataR.push([timeR, valueR]);
    }

    myChartR.setOption({
        series: [{ data: dataR }]
    });

    // 🔥 UPDATE TEMPS RÉEL (manquait chez toi)
    setInterval(() => {
        let valueR = Math.random() * 50 * 1024 * 1024;
        addDataPointR(valueR);
    }, 2000);
}

// 🔥 APPEL (manquait chez toi)
BuildReseauChart([]);
</script>