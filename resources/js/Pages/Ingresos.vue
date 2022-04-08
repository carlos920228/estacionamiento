<template>
<app-layout>
        <template #header>
            <h1 class="text-center text-2xl font-bold leading-7 text-gray-300 sm:text-3xl sm:truncate py-4 bg-gradient-to-l from-indigo-500 to-indigo-800 ">
                Ingreso diario por Estacionamiento</h1>
                {{ingresos}}
        </template>
       <template>
    <div>
        <Bar />
    </div>
</template>
</app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Link } from '@inertiajs/inertia-vue3';
import { Bar, Line  } from 'vue-chartjs';
import { shuffle } from 'lodash';
import { computed, defineComponent, ref } from 'vue';
import { DoughnutChart } from 'vue-chart-3';
import VueCharts from 'vue-chartjs';
import { Chart, DoughnutController, ArcElement, Tooltip } from 'chart.js';
Chart.register(DoughnutController, ArcElement, Tooltip);
export default ({
  
  components: { 
      DoughnutChart,
      AppLayout,
      Bar
      },
        props:{
        ingresos: Array,
    },
   extends: Bar,
  mounted () {
    // Overwriting base render method with actual data.
    this.renderChart({
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: 'GitHub',
          backgroundColor: '#f87979',
          data: [40, 20, 12, 39, 10, 40, 39, 80, 40, 20, 12, 11]
        }
      ]
    })}
});
</script>
