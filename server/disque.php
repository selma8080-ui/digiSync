<?php

/*
Filesystem      Size  Used Avail Use% Mounted on
none            1.8G     0  1.8G   0% /usr/lib/modules/6.6.87.2-microsoft-standard-WSL2
none            1.8G  4.0K  1.8G   1% /mnt/wsl
drivers         238G  161G   78G  68% /usr/lib/wsl/drivers
/dev/sdd       1007G  1.8G  954G   1% /
none            1.8G   80K  1.8G   1% /mnt/wslg
none            1.8G     0  1.8G   0% /usr/lib/wsl/lib
rootfs          1.8G  2.7M  1.8G   1% /init
none            1.8G  492K  1.8G   1% /run
none            1.8G     0  1.8G   0% /run/lock
none            1.8G     0  1.8G   0% /run/shm
none            1.8G   76K  1.8G   1% /mnt/wslg/versions.txt
none            1.8G   76K  1.8G   1% /mnt/wslg/doc
C:\             238G  161G   78G  68% /mnt/c
tmpfs           362M   20K  362M   1% /run/user/1000
*/


exec('df -h /', $output);

$line = preg_split('/\s+/', trim($output[1]));


echo json_encode([
  "total" => $line[1],
  "used" => $line[2],
  "available" => $line[3],
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