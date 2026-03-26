<template>
    <list-layout
        ref="listLayoutRef"
        :dataSource="gridDataSource"
        :gridColumns="gridColumnsData"
        :gridOptions="gridOptionsData"
        @grid-updated="onGridUpdated"
        @grid-mounted="onGridMounted"
        @grid-click="onGridClick">
        <template #left-button-area>
            <button class="basic-btn left-btn-01 h-full mr-2" type="button">버튼1</button>
            <button class="basic-btn left-btn-02 h-full" type="button">버튼2</button>
        </template>
    </list-layout>
</template>

<script setup>
import { ref } from 'vue';
import ListLayout from '@/components/listLayout.vue';
import { useModalStore } from '@/stores/modalStore';

const gridDataSource = ref([]);
const gridColumnsData = [{
    header: "컬럼1",
    name: "columns_1",
    minWidth: 100,
    className: "cursor-pointer",
    align: "center",
    formatter: ({ value }) => value ? value : "-"
},
{
    header: "컬럼2",
    name: "columns_2",
    minWidth: 100,
    className: "cursor-pointer",
    align: "center",
    formatter: ({ value }) => value ? value : "-"
},
{
    header: "컬럼3",
    name: "columns_3",
    minWidth: 100,
    className: "cursor-pointer",
    align: "center",
    formatter: ({ value }) => value ? value : "-"
}];

const gridOptionsData = {
    
}

const onGridUpdated = (ev) => {
    console.log( 'LandingPage - onGridUpdated', ev );
};

const onGridMounted = (ev) => {
    console.log( 'LandingPage - onGridMounted', ev );
};

const onGridClick = (ev) => {
    console.log( 'LandingPage - onGridClick', ev);
};

</script>