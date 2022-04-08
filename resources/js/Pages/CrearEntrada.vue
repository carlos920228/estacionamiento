<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registrar entrada</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                <form @submit.prevent="submit" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                
                <div class="grid grid-cols-1">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">placas</label>
                    <input 
                    id="placas"
                    v-model="form.placas"
                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Placas" 
                    required/>
                </div>
                 <div class="grid grid-cols-1">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">descripcion</label>
                    <input 
                    id="descripcion"
                    v-model="form.descripcion"
                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Descripción del vehículo" 
                    required/>
                </div>
                 <div class="grid grid-cols-1">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Estacionamieto</label>
                    <select  class="form-control" id="estacionamiento" placeholder="Selecciona el estacionamiento" v-model="form.estacionamientos_id" required>                   
                    <option  v-for="estacionamiento in estacionamientos" :key="estacionamiento.id" v-bind:value="estacionamiento.id" >{{estacionamiento.nombre}}</option>
                    </select>
                </div>
                 <div class="grid grid-cols-1">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Costo</label>
                    <select  class="form-control" id="costo" placeholder="Selecciona el costo" v-model="form.costo" required>                   
                    <option  v-for="costo in costos" :key="costo.precio" v-bind:value="costo.precio">{{costo.tipoVehiculo}}: ${{costo.precio}}</option>
                    </select>
                </div>
                <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Tipo de vehículo</label>
                <select name="select" id='tipo' v-model="form.tipo" required>
                          <option value="Camioneta">Camioneta</option>
                          <option value="Coche" selected="selected">Coche</option>
                          <option value="Moto" >Moto</option>
                        </select> 
                </div>
                </div>
            
            
                <div class='flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5'>
                     <button>
                <Link
                    :href="route('entradas.index')"                    
                    class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2' type="button">
                    Cancelar
                </Link> 
                     </button>
                <button 
                    type="submit"
                    class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'
                >
                    Guardar
                </button>
                </div>
            
                </form>
										
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout";
export default {
    props:{
        erros: Object,
        estacionamientos:Array,
        costos:Array
    },
    components:{
        AppLayout,
        Link
    },
    data(){
    return{
      form:{
          nombre:null
      }  
    }
    },
    methods:{
        submit(){
            this.$inertia.post(route('entradas.store'),this.form);
        }
    }
}
</script>