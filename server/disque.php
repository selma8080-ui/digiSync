<div id="disqueChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function buildDisqueChart(data) {

    const el = document.getElementById('disqueChart');
    const chart = echarts.init(el);

    chart.setOption({
        title: {
            text: 'Disque Usage',
            left: 'center'
        },

       tooltip: {
    trigger: 'item',
    formatter: function (params) {
        return params.name + ' : ' + params.percent + '%';
    }
},

        legend: { show: false },

        series: [{
            type: 'pie',
            radius: '70%',

            label: { show: false },
            labelLine: { show: false },

            data: [
                { value: data.hddUsed, name: 'Used' },
                { value: data.hddAvailable, name: 'Free' }
            ]
        }]
    });

}
</script>