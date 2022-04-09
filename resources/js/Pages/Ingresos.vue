<template>
<app-layout>
        <template #header>
            <h1 class="text-center text-2xl font-bold leading-7 text-gray-300 sm:text-3xl sm:truncate py-4 bg-gradient-to-l from-indigo-500 to-indigo-800 ">
                Ingreso diario por Estacionamiento</h1>
              
                </template>
                <div class="py-12 center">
                <div style="max-width:30%; max-height:40%;padding-left:10px;">                   
                    <Bar
                        :chart-options="chartOptions"
                        :chart-data="chartData"
                        :chart-id="Ingresos"
                        :dataset-id-key="datasetIdKey"
                        :plugins="plugins"
                        :css-classes="cssClasses"
                        :styles="styles"
                        :width="width"
                        :height="height"
                    />
                </div>
                </div>
                
</app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Link } from '@inertiajs/inertia-vue3';
import { Bar, Line,  } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
export default ({
  name: 'BarChart',
  components: { 
      AppLayout,
      Bar,
      Link,
      },
        props:{
        ingresos: Array,
        estacionamientos:Array,
        chartId: {
      type: String,
      default: 'Ingresos'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: 100
    },
    height: {
      type: Number,
      default: 100
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Object,
      default: () => {}
    }
  },
  data() {
      var labels=[];
      var datasets=[];
      this.ingresos.forEach(element => {
          labels.push(element.nombre);
          datasets.push(element.total);
      });
    return {
      chartData: {
        labels:labels,
        datasets: [ {label:"Ingresos",backgroundColor:["red","blue","green","Yellow","Orange"], data: datasets } ]
      },
      chartOptions: {
        responsive: true,
        puglins:{
             legend:{display:false}
        }
      }
      
    }
  }
});
</script>