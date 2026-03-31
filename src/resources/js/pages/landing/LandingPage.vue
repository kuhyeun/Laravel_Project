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
import UserDetail from '@/components/modals/UserDetails.vue';

const modalStore = useModalStore();

const gridDataSource = ref([]);
const gridColumnsData = [{
    header: "컬럼1",
    name: "columns_1",
    minWidth: 100,
    align: "center",
    formatter: ({ value }) => value ? value : "-"
},
{
    header: "컬럼2",
    name: "columns_2",
    minWidth: 100,
    align: "center",
    formatter: ({ value }) => value ? value : "-"
},
{
    header: "컬럼3",
    name: "columns_3",
    minWidth: 100,
    className: "cursor-pointer",
    editor: "text",
    align: "center",
    formatter: ({ value }) => value ? value : "-"
}];

const gridOptionsData = {
    rowHeaders: [{
        type: "checkbox"
    }],
    scrollY: true
}

const onGridUpdated = (ev) => {
    console.log( 'LandingPage - onGridUpdated', ev );
};

const onGridMounted = (ev) => {
    console.log( 'LandingPage - onGridMounted', ev );
};

const onGridClick = (ev) => {
    console.log( 'LandingPage - onGridClick', ev);

    // 임시 사용자 데이터 (실제로는 ev 객체에서 클릭된 행의 데이터를 가져와야 함)
    const dummyUser = {
        name: '홍길동',
        email: 'test@example.com',
        joined: '2024-01-01',
        id: ev.rowKey || 'temp_id' // grid 이벤트에서 rowKey나 id를 가져옵니다
    };

    const modalOptions = {
        size: "lg",
        closeOnClickOutside: true, // modal 밖 영역 클릭시 닫힘처리 - Default : true
        closeOnEsc: true // Esc키 닫힘처리 - Default : true
    };

    modalStore.open( UserDetail, { user: dummyUser }, modalOptions );
};

</script>