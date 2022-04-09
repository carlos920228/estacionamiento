<template>
<app-layout>
        <template #header>
            <h1 class="text-center text-2xl font-bold leading-7 text-gray-300 sm:text-3xl sm:truncate py-4 bg-gradient-to-l from-indigo-500 to-indigo-800 ">
                Cantidad de vehiculos hospedados por Hora</h1>
              
                </template>
                
                 <div>
                <apexchart width="90%" type="bar" :options="options" :series="series"></apexchart>
                </div>         
</app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Link } from '@inertiajs/inertia-vue3';
import VueApexCharts from "vue3-apexcharts";
export default ({
  name: 'BarChart',
  components: { 
      AppLayout,
      Link,
      apexchart: VueApexCharts,
      },
      props:{
        vehiculos: Array,
        estacionamientos:Array,
        camioneta:Array,
        coche:Array,
        moto:Array,
        aco:Array
      },
      data: function() {
     var estacionamientos=[];
      var datasets=[];
      this.estacionamientos.forEach(element => {
          estacionamientos.push(element.nombre);
           
      });
     
    return {
      options: {
        chart: {
          id: 'vuechart'
        },
        xaxis: {
          categories:['00','01','02','03','04','05','06','07','08','09','10',
      '11','12','13','14','15','16','17','18','19','20','21','22','23','24']
        }
      },
      series: [{
            name: this.estacionamientos[0]['nombre'],
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 55, 57, 56, 61, 58, 63, 60, 66, 55, 57, 56, 61, 58, 63, 60, 66]
          }, {
            name: this.estacionamientos[1]['nombre'],
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
          }, {
            name: this.estacionamientos[2]['nombre'],
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
          },{           
            name: this.estacionamientos[3]['nombre'],
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
          }, {
            name: this.estacionamientos[4]['nombre'],
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
          }]
          
    }
  }
               
});
</script>