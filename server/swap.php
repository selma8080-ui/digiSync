<!DOCTYPE html>
 <html lang="en">
 <head>

    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>

    <div id="app">
       <div id="chart" style="width:600px;height:400px;"></div>
    </div>

 <script>
const app = Vue.createApp({
    data(){
        return{
            swapPercent: <?= round($percent,2) ?>,
            chart: null
        }
    },

    methods:{
        initChart() {
            this.chart = echarts.init(document.getElementById('chart'));

            let option = {
               tooltip: {
                    formatter: '{a} <br/>{b} : {c}%'
                    },
                series: [
                    {
                        name: 'Pressure',
                        type: 'gauge',
                        progress: {
                        show: true
                    },
                        detail: {
                            formatter: '{value} %'
                        },
                        data: [
                            {
                                value: this.swapPercent
                            }
                        ]
                    }
                ]
            };

            this.chart.setOption(option);
        }
    },

    mounted(){
        this.initChart();
    }
});

app.mount('#app');
</script>



