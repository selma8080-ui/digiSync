<?php
$used = 40;  
$available = 60; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
</head>
<body>
    <div id="app">
        <div id="chart" style="width: 400px;height: 400px;"></div>
    </div>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    disqueUsed: <?= json_encode($used) ?>,
                    disqueAvailable: <?= json_encode($available) ?>,
                    chart: null
                }
            },
            methods: {
                initChart() {
                    this.chart = echarts.init(document.getElementById("chart"));
                    this.chart.setOption({
                        title: {
                            text: 'Disque Usage',
                            left: 'center'
                        },

                        tooltip: {
                            trigger: 'item'
                        },

                        legend: {
                            orient: 'vertical',
                            left: 'left'
                        },

                        series: [{
                            name: 'Access From',
                            type: 'pie',
                            radius: '50%',
                            data: [],
                            emphasis: {
                                itemStyle: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }]
                    });
                },

                updateChart() {
                    this.chart.setOption({
                        series: [{
                            data: [
                                { value: this.disqueUsed, name: "Used" },
                                { value: this.disqueAvailable, name: "Available" }
                            ]
                        }]
                    });
                }
            },

            mounted() {
                console.log("mounted works");
                this.initChart();
                this.updateChart();
            }
        });

        app.mount('#app');
    </script>
</body>
</html>