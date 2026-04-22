<?php
exec('free -m', $output);

/*
                total        used        free      shared  buff/cache   available
Mem:            3619         419        2494           5         785        3199
Swap:           1024           0        1024/cache, available)*/

$memLine = preg_split('/\s+/', $output[1]);

$total = $memLine[1];
$used = $memLine[2];
$available = $memLine[6];

$percent = ($used / $total) * 100;
?>
 



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
            ramPercent: <?= round($percent,2) ?>,
            chart: null
        }
    },

    methods:{
        initChart() {
            this.chart = echarts.init(document.getElementById('chart'));

            let option = {
                series: [
                    {
                        type: 'gauge',
                        axisLine: {
                            lineStyle: {
                                width: 30,
                                color: [
                                    [0.3, '#67e0e3'],
                                    [0.7, '#37a2da'],
                                    [1, '#fd666d']
                                ]
                            }
                        },
                        pointer: {
                            itemStyle: {
                                color: 'auto'
                            }
                        },
                        axisTick: {
                            distance: -30,
                            length: 8,
                            lineStyle: {
                                color: '#fff',
                                width: 2
                            }
                        },
                        splitLine: {
                            distance: -30,
                            length: 30,
                            lineStyle: {
                                color: '#fff',
                                width: 4
                            }
                        },
                        axisLabel: {
                            color: 'inherit',
                            distance: 40,
                            fontSize: 20
                        },
                        detail: {
                            formatter: '{value} %'
                        },
                        data: [
                            {
                                value: this.ramPercent
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