<template>
  <component :is="iconComponent" />
</template>

<script setup>
import { computed } from 'vue';
import HeroiconMBars3BottomLeft from '@/Components/icons/heroicon-m-bars-3-bottom-left.svg';
import HeroiconMInformationCircle from '@/Components/icons/heroicon-m-information-circle.svg';

// 초기 렌더링이 필요한 경우 ex) Frame 아이콘, Menu 아이콘
const iconMap = {
  'heroicon-m-bars-3-bottom-left': HeroiconMBars3BottomLeft,
  'heroicon-m-information-circle': HeroiconMInformationCircle,
};

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
});

const iconComponent = computed(() => iconMap[props.name]);
</script>
