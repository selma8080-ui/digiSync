const { createApp } = Vue;
   createApp({
       data() {
           return {
               info: null,
               timer: null
           }
       },
       mounted() {
           // Initial call
           this.fetchData();
           // Fetch data every 30 seconds
           this.timer = setInterval(this.fetchData, 3000);
       },
       methods: {
           fetchData() {
               axios.get('Model/Service/DataMapperService.php').then(response => {
					console.log(response.data);
                    this.info = response.data;
					
					buildDisqueChart(this.info.hddTotal);
					buildRamChart(this.info.ramTotal);
					
             	}).catch(error => console.log(error));
           }
       },
       beforeUnmount() {
           // Clear timer when component is destroyed
           clearInterval(this.timer);
       }
   }).mount('#appSync');
        			