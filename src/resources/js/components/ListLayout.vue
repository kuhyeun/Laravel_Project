<template>
    <div class="flex px-2 w-full h-[35px]">
        <div>
            <slot name="left-button-area"></slot>
        </div>
        <div class="flex-1"></div>
        <div>
            <select name="searchType" class="h-full mr-2">
                <option value="all">통합검색</option>
                <option value="name">이름</option>
                <option value="code">코드</option>
            </select>
            <input class="h-full mr-2" type="text" name="searchValue" placeholder="검색어" />
            <button class="searchBtn h-full" type="button" name="searchBtn" @click="handleSearch">검색</button>
        </div>
    </div>

    <div class="flex-1 mt-[15px]" ref="gridContainer"></div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useApi } from '../composables/useApi';
import { useGrid } from '../composables/useGrid';

const props = defineProps({
    dataSource: { type: Object, required: true },
    gridColumns: { type: Array, required: true },
    gridOptions: { type: Object, required: true }
});

const emit = defineEmits( ["grid-mounted", "grid-updated", "grid-click"] );

const gridContainer = ref( null );
const { data, isLoading, error, get } = useApi();
const { gridInstance, setGrid } = useGrid();

const handleGridMounted = (ev) => {
    console.log( 'HandleGridMounted' );

    // DEBUG
    
    gridInstance.value?.appendRow( { columns_1: "데이터 1-1", columns_2: "데이터 1-2", columns_3: "데이터 1-3"} );
    gridInstance.value?.appendRow( { columns_1: "데이터 2-1", columns_2: "데이터 2-2", columns_3: "데이터 2-3"} );
    gridInstance.value?.appendRow( { columns_1: "데이터 3-1", columns_2: "데이터 3-2", columns_3: "데이터 3-3"} );
    gridInstance.value?.appendRow( { columns_1: "데이터 4-1", columns_2: "데이터 4-2", columns_3: "데이터 4-3"} );
    
    emit( "grid-mounted", ev );
};

const handleGridUpdated = (ev) => {
    console.log( 'HandleGridUpdated' );
    
    emit( "grid-updated", ev );
};

const handleGridClick = (ev) => {
    console.log( 'HandleGridClick' );
    
    emit( "grid-click", ev );
};

onMounted( async () => {
    let options = {
        columns : props.gridColumns,
        data: props.dataSource || [],
        ...props.gridOptions
    };

    setGrid( gridContainer, options );

    // 내부 핸들러를 TUI Grid 이벤트에 연결
    gridInstance.value?.on( "onGridMounted", handleGridMounted );
    gridInstance.value?.on( "onGridUpdated", handleGridUpdated );
    gridInstance.value?.on( "click", handleGridClick );
});

const handleSearch = async () => {
    gridInstance.value?.reloadData();
}
</script>