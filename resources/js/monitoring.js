const { createApp } = Vue;
   createApp({
       data() {
           return {
               info: null,
               docs: [],
               timer: null
           }
       },
       mounted() {
           this.fetchData();
           this.timer = setInterval(this.fetchData, 3000);
       },
       methods: {
           fetchData() {
               axios.get('Model/Service/DataMapperService.php').then(response => {
					console.log(response.data);
                    this.info = response.data;

                    this.docs = response.data.data ?? [];
					
					buildDisqueChart(this.info);
					buildRamChart(this.info.ramTotal);
                    BuildCpuChart(this.info);
					
             	}).catch(error => console.log(error));
           }
       },
       beforeUnmount() {
           clearInterval(this.timer);
       }
   }).mount('#appSync');
        			