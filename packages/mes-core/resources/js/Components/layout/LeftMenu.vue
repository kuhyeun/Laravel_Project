<template>
    <div class="w-[250px] whitespace-nowrap">
        <nav class="p-3">
            <ul>
                <MenuItem
                v-for="item in menuItems"
                :key="item.menu_idx ?? item.id ?? item.menu_route_name ?? item.menu_name"
                :menu-item="item">
                </MenuItem>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import MenuItem from './MenuItem.vue';

const props = defineProps({
    menuItems: {
        type: Array,
        default: () => [],
    },
});
</script>
