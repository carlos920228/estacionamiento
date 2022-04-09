<template>
<app-layout>
        <template #header>
            <h1 class="text-center text-2xl font-bold leading-7 text-gray-300 sm:text-3xl sm:truncate py-4 bg-gradient-to-l from-indigo-500 to-indigo-800 ">
                Cantidad y tipo de vehiculos hospedados por día</h1>
              
                </template>
                
                <div>
                <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>
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
        moto:Array
      },
      data: function() {
     var estacionamientos=[];
      var datasets=[];
      var tipos=['Coche','Camioneta','Moto'];
      this.estacionamientos.forEach(element => {
          estacionamientos.push(element.nombre);
           
      });
     
    return {
      options: {
        chart: {
          id: 'vuechart'
        },
        xaxis: {
          categories: estacionamientos
        }
      },
      series: [{
        name: 'Moto',
        data: this.moto
      },{
        name: 'Coche',
        data: this.coche
      }
      ,{
        name: 'Camioneta',
        data: this.camioneta
      }
      ]
    }
  }
               
});
</script>