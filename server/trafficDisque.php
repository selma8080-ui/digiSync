<div id="trafficDisqueChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function BuildRamChart(data) {

    var trafficDisqueChart = document.getElementById('trafficDisqueChart');
    var myChart = echarts.init(trafficDisqueChart);
    
    let dataD = data;
    let maxDuration = 6 * 3600 * 1000; 

    var option = {
        tooltip: {
            trigger: 'axis'
        },
        title: {
            left: 'center',
            text: 'Traffic Disque'
        },
        xAxis: {
            type: 'time',
            axisLabel: {
                formatter: function (value) {
                    let d = new Date(value);
                    return d.getHours() + ':' + String(d.getMinutes()).padStart(2, '0');
                }
            }
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: function (value) {
                    return (value / (1024 * 1024)).toFixed(2) + ' MB';
                }
            }
        },
        series: [{
            name: 'Utilisation Disque',
            type: 'line',
            smooth: true,
            symbol: 'none',
            areaStyle: {},
            data: dataD   // ✔ CORRIGÉ
        }]
    };

    myChart.setOption(option);

    function addDataPoint(value) {
        let now = new Date().getTime();

        dataD.push([now, value]);

        // garder seulement les données sur 6h
        dataD = dataD.filter(point => now - point[0] <= maxDuration);

        myChart.setOption({
            series: [{
                data: dataD   // ✔ CORRIGÉ
            }]
        });
    }

    // données initiales
    let now = new Date().getTime();
    for (let i = 0; i < 50; i++) {
        let time = now - (50 - i) * 2000;
        let value = Math.random() * 50 * 1024 * 1024;
        dataD.push([time, value]);
    }

    myChart.setOption({
        series: [{
            data: dataD   // ✔ CORRIGÉ
        }]
    });

    // mise à jour toutes les 2 secondes
    setInterval(() => {
        let value = Math.random() * 50 * 1024 * 1024;
        addDataPoint(value);
    }, 2000);
}

// ✔ IMPORTANT : appel de la fonction
BuildRamChart([]);
</script>