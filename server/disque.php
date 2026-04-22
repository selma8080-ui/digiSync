
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
                    disqueUsed: <?= $used ?>,
                    disqueAvailable: <?= $available ?>,
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
                            data: [
                                { value: 0, name: 'Used' },
                                { value: 100, name: 'Available' }
                            ],
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
                                {value: this.disqueUsed, name: "Used"},
                                {value: 100 - this.disqueAvailable, name: "Available"}
                            ],
                        }]
                    });
                },
                
                loadData() {
                    axios.get('disque.php').then(res => {
                        this.disqueUsed = res.data.used;
                        this.updateChart();
                    });
                }
            },

            mounted() {
                this.initChart();
                this.loadData();

                setInterval(() => {
                    this.loadData();
                }, 2000);
            }
        });

        app.mount('#app');
    </script>
</body>
</html>