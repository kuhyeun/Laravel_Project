<template>
    <div class="w-full max-w-[600px] p-4">
        <Bar :data="chartData" :options="chartOptions" />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, LineElement, PointElement, CategoryScale, LinearScale } from 'chart.js';
import AppLayout from '@core/Layouts/AppLayout.vue';

defineOptions({
    layout: AppLayout
});

ChartJS.register( Title, Tooltip, Legend, BarElement, LineElement, PointElement, CategoryScale, LinearScale );

const chartData = ref({
    labels: ['1월', '2월', '3월', '4월', '5월', '6월'],
    datasets: [
        {
            type: 'bar',
            label: '생산량',
            backgroundColor: '#4D8FFA',
            data: [120, 150, 180, 90, 200, 170],
            order: 1
        },
        {
            type: 'line',
            label: '불량수',
            borderColor: '#EF4444',
            backgroundColor: '#EF4444',
            data: [5, 8, 3, 12, 6, 4],
            order: 0
        },
    ],
});

const chartOptions = ref({
    responsive: true,
    plugins: {
        title: {
            display: true,
            text: '월별 생산 현황',
        },
        legend: {
            position: 'top',
        },
    },
});
</script>