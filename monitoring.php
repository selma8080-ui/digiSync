
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@<x.x.x>/dist/axios.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="app">
        
    </div>



    <script>
        const app = Vue.createApp ({
            data() {
                return {
                    data: null,
                    intervalId: null
                }
            },
            methods: {
                fetchData() {
                axios.get('Model/Service/DataMapperService.php')
                    .then(response => {
                    this.data = response.data;
                    })
                    .catch(error => {
                    console.error(error);
                    });
                }
            },
            mounted() {
                this.fetchData();

                this.intervalId = setInterval(() => {
                this.fetchData();
                }, 1000);
            },
            beforeUnmount() {
                clearInterval(this.intervalId);
            }
        })
        app.mount('#app');
    </script>
</body>
</html>