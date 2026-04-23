
<?php 
    $used = [20, 34,34 ,43,43];
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
                cpuUsed: 0,
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
                        data: this.times
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
                        smooth: true,
                        areaStyle: {},
                        data: this.values
                    }]
                });
            },
        },

        mounted() {
            this.values = <?= json_encode($used) ?>;
            this.times = this.values.map((_, i) => `t${i}`);

            this.initChart();
        }
    });

    app.mount('#app');
</script>

</body>
</html>

