<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Estacionamientos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Estacionamientos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{estacionamientos}}
                    aco aco..

                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
export default{
props:['estacionamientos'],
}
</script>
