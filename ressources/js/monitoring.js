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
        app.mount('#appSync');
