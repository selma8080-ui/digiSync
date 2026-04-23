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
      chart: null
    }
  },
  mounted() {
    this.initChart();
  },
  methods: {
    initChart() {
      this.chart = echarts.init(document.getElementById('chart'));

      const TOTAL_POINTS = 100;
      const SIX_HOURS_MS = 6 * 3600 * 1000;
      const INTERVAL = SIX_HOURS_MS / TOTAL_POINTS; 
      
      let base = +new Date(2026, 3, 23, 8, 0, 0); 
      let data = [];

      for (let i = 0; i < TOTAL_POINTS; i++) {
        let now = new Date(base + i * INTERVAL);
        data.push([+now, Math.round(Math.random() * 5000)]); 
      }

      const option = {
        tooltip: {
          trigger: 'axis',
          formatter: (params) => {
            let date = new Date(params[0].value[0]);
            let timeStr = date.getHours() + ':' + date.getMinutes().toString().padStart(2, '0');
            return timeStr + '<br/>Trafic : ' + params[0].value[1].toLocaleString() + ' Octets';
          }
        },
        xAxis: {
          type: 'time',
          boundaryGap: false,
          axisLabel: { formatter: '{HH}:{mm}', hideOverlap: true }
        },
        yAxis: {
          type: 'value',
          name: 'Débit',
          axisLabel: {
            formatter: function (value) {
              if (value >= 1024 * 1024) return (value / (1024 * 1024)).toFixed(1) + ' Mo';
              if (value >= 1024) return (value / 1024).toFixed(1) + ' Ko';
              return value + ' B';
            }
          }
        },
        series: [{
          name: 'Trafic Octets',
          type: 'line',
          smooth: true,
          symbol: 'none',
          areaStyle: {
            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
              { offset: 0, color: 'rgb(58, 77, 233)' },
              { offset: 1, color: 'rgb(15, 20, 50)' }
            ])
          },
          data: data
        }]
      };

      this.chart.setOption(option);

      setInterval(() => {
        let lastTime = data[data.length - 1][0];
        let nextTime = lastTime + INTERVAL;
        let nextValue = <?= $traffic ?>;

        data.shift(); 
        data.push([nextTime, nextValue]);

        this.chart.setOption({
          series: [{ data: data }]
        });
      }, 2000); 
    }
  }
}).mount('#app');
</script>
</body>
</html>