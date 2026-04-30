<div id="disqueChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const el = document.getElementById('disqueChart');
    const chart = echarts.init(el);

    chart.setOption({
        title: {
            text: 'Disque Usage',
            left: 'center'
        },

        tooltip: {
            trigger: 'item',
            formatter: '{b} : {c} ({d}%)'   // 🔥 % affiché au hover
        },

        legend: { show: false },

        series: [{
            type: 'pie',
            radius: '70%',

            label: { show: false },
            labelLine: { show: false },

            data: [
                { value: 70, name: 'Used' },
                { value: 30, name: 'Free' }
            ]
        }]
    });

});
</script>