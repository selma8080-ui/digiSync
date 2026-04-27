<?php

$data = [
    [strtotime("2026-04-23 08:00") * 1000, 120000000], 
    [strtotime("2026-04-23 09:00") * 1000, 180000000], 
    [strtotime("2026-04-23 10:00") * 1000, 220000000],
    [strtotime("2026-04-23 11:00") * 1000, 150000000],
    [strtotime("2026-04-23 12:00") * 1000, 300000000], 
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>

</head>
<body>
    <div id="app">
       <div id="chart" style="width:600px;height:400px;"></div>
    </div>

    <script>
      const app = Vue.createApp({
          data() {
              return {
                  chart: null,
                  data: <?= json_encode($data ?? []) ?>
              }
          },

          methods: {
              formatHour(ts) {
                  let d = new Date(ts);
                  return d.getHours().toString().padStart(2, '0') + ":00";
              },

              formatBytes(bytes) {
                  if (bytes < 1024) return bytes + " B";
                  if (bytes < 1024 ** 2) return (bytes / 1024).toFixed(1) + " KB";
                  if (bytes < 1024 ** 3) return (bytes / 1024 ** 2).toFixed(1) + " MB";
                  return (bytes / 1024 ** 3).toFixed(1) + " GB";
              },

              filterLast6Hours() {
                  let sixHoursAgo = Date.now() - (6 * 3600 * 1000);

                  this.data = this.data.filter(item => item[0] >= sixHoursAgo);
              },

              initChart() {
                this.chart = echarts.init(document.getElementById("chart"));

                this.chart.setOption({
                    title: {
                        left: 'center',
                        text: 'Traffic Disque'
                    },

                    tooltip: {
                        trigger: 'axis',
                        position: function (pt) {
                            return [pt[0], '10%'];
                        },
                        formatter: (params) => {
                            let time = new Date(params[0].value[0]).toLocaleTimeString();
                            let val = params[0].value[1];
                            return `${time}<br>${this.formatBytes(val)}`;
                        }
                    },

                    xAxis: {
                        type: 'time',
                        boundaryGap: false,
                        axisLabel: {
                            formatter: (value) => this.formatHour(value)
                        }
                    },

                    yAxis: {
                        type: 'value',
                        boundaryGap: [0, '100%'],
                        axisLabel: {
                            formatter: (value) => this.formatBytes(value)
                        }
                    },

                    dataZoom: [
                        {
                            type: 'inside',
                            start: 0,
                            end: 100
                        },
                        {
                            start: 0,
                            end: 100
                        }
                    ],

                    series: [
                        {
                            name: 'Usage',
                            type: 'line',
                            smooth: true,
                            symbol: 'none',
                            areaStyle: {}, 
                            data: this.data
                        }
                    ]
                });
            }
          },

          mounted() {
              this.filterLast6Hours();

              this.initChart();
          }
      });

      app.mount('#app');
    </script>

</body>
</html>