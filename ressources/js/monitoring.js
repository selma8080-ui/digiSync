const { createApp } = Vue;
   createApp({
       data() {
           return {
               info: null,
               timer: null
           }
       },
       mounted() {
           this.fetchData();
           this.timer = setInterval(this.fetchData, 30000);
       },
       methods: {
           fetchData() {
               axios.get('Model/Service/DataMapperService.php')
                   .then(response => {
                       this.info = response.data;
                       BuildDisqueChart([
                            { value: this.info.hddUsed},
                            { value: this.info.hddAvailable}
                        ]);
                   })
                   .catch(error => console.log(error));
           }
       },
       beforeUnmount() {
           clearInterval(this.timer);
       }
   }).mount('#appSync');
        			