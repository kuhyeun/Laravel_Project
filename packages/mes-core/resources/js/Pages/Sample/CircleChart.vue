<template>
    <div>
        <div class="flex flex-row justify-center">
            <div class="flex-1 p-4 max-w-[700px]">
                <BasicChart type="pie" :data="chartData" :options="chartOptions" />
            </div>

            <div class="flex-1 p-4 max-w-[700px]">
                <BasicChart type="doughnut" :data="chartData" :options="chartOptions2" />
            </div>

        </div>
        <div class="h-[35px] mt-4 text-center">
            <button class="basic-btn h-full mr-2" type="button" @click="randomize">Randomize</button>
            <button class="basic-btn h-full mr-2" type="button" @click="addDataset">Add Dataset</button>
            <button class="basic-btn h-full mr-2" type="button" @click="addData">Add Data</button>
            <button class="basic-btn h-full mr-2" type="button" @click="removeDataset">Remove Dataset</button>
            <button class="basic-btn h-full" type="button" @click="removeData">Remove Data</button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { getRandomColor } from '@core/Utils/common';
import { useCircleChartDebug } from '@core/Composables/useChartDebug';
import BasicChart from '@core/Components/basic/BasicChart.vue';
import AppLayout from '@core/Layouts/AppLayout.vue';

defineOptions({
    layout: AppLayout
});

const backgroundColors = [ getRandomColor(), getRandomColor(), getRandomColor() ];

const chartData = ref({
    labels: ['L1', 'L2', 'L3'],
    datasets: [
        {
            label: 'D1',
            backgroundColor: backgroundColors,
            data: [ 0, 0, 0 ]
        },
        {
            label: 'D2',
            backgroundColor: backgroundColors,
            data: [ 0, 0, 0 ]
        },
    ],
});

const chartOptions = ref({
    responsive: true,
    plugins: {
        title: {
            display: true,
            text: 'Pie Chart',
        },
        legend: {
            position: 'top',
        },
    },
});

const chartOptions2 = ref({
    responsive: true,
    plugins: {
        title: {
            display: true,
            text: 'Doughnut Chart',
        },
        legend: {
            position: 'top',
        },
    },
})

const { randomize, addDataset, addData, removeDataset, removeData } = useCircleChartDebug( chartData );

onMounted(() => {
    randomize();
});

</script>