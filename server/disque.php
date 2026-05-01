<div id="disqueChart" style="width:100%; height:300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts"></script>

<script>
function buildDisqueChart(data) {
    const el = document.getElementById('disqueChart');
    const chart = echarts.init(el);

    chart.setOption({
        title: {
            text: 'Disque Usage',
            left: 'center',
            top: '3%' 
        },

        legend: { 
            show: true,
            top: '15%', 
            left: 'center',
            data: ['Used', 'Free'] 
        },

        tooltip: {
            trigger: 'item',
            formatter: '{b} : {d}%'
        },

        series: [{
            name: 'Usage',
            type: 'pie',
            radius: '70%',
            center: ['50%', '60%'], 

            label: { 
                show: true,
                position: 'inside',
                formatter: '{d}%',
                color: '#fff',
                fontWeight: 'bold',
                fontSize: 14
            },
            
            data: [
<<<<<<< HEAD
                { value: parseFloat(data.hddAvailable), name: 'Free' },
                { value: parseFloat(data.hddUsed), name: 'Used' }
=======
                { value: data.hddUsed, name: 'Used' },
                { value: data.hddAvailable, name: 'Free' }
>>>>>>> 4ee56ba254892fd9360792f1497881a182521cd5
            ]
        }]
    });
}
</script>