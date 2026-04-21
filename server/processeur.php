<?php 

exec('vmstat 1 2', $output);

/*
procs -----------memory---------- ---swap-- -----io---- -system-- -------cpu-------
 r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st gu
 0  0      0 3410420   3488 153972    0    0    62   919   53    0  0  0 100  0  0  0
 0  0      0 3410420   3488 153972    0    0     0     0   41   48  0  0 100  0  0  0
*/


$cpuLine = preg_split('/\s+/', trim($output[3]));

$available = $cpuLine[14];
$used = 100 - $available;

header('Content-Type: application/json');

echo json_encode([
  "total" => 100,
  "used" => $used,
  "available" => $available
]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>
</head>

<body>

<div id="app">
    <div id="chart" style="width: 250px;height: 250px;"></div>
</div>

<script>
const app = Vue.createApp({
    data() {
        return {
            cpuUsed: <?= $used ?>,
            times: [],
            values: [],
            chart: null
        }
    },

    methods: {
        initChart() {
            this.chart = echarts.init(document.getElementById('chart'));

            this.chart.setOption({
                title: {
                    text: 'CPU Usage'
                },

                tooltip: {
                    trigger: 'axis',
                    formatter: (params) => {
                        return `CPU: ${params[0].value}%`;
                    }
                },

                xAxis: {
                    type: 'category',
                    data: []
                },

                yAxis: {
                    type: 'value',
                    min: 0,
                    max: 100,
                    axisLabel: {
                        formatter: '{value}%'
                    }
                },

                series: [{
                    type: 'line',
                    areaStyle: {},
                    data: []
                }]
            });
        },

        updateChart() {
            let now = new Date().toLocaleTimeString();

            this.times.push(now);
            this.values.push(this.cpuUsed);

            if (this.times.length > 10) {
                this.times.shift();
                this.values.shift();
            }

            this.chart.setOption({
                xAxis: {
                    data: this.times
                },
                series: [{
                    data: this.values
                }]
            });
        },

        loadData() {
            axios.get('processeur.php').then(res => {
                this.cpuUsed = res.data.used;
                this.updateChart();
            });
        }
    },

    mounted() {
        this.initChart();
        this.updateChart();

        setInterval(() => {
            this.loadData();
        }, 2000);
    }
});

app.mount('#app');
</script>

</body>
</html>

