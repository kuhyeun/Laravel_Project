<template>
    <div class="flex flex-col h-screen">
        <header class="border-b">
            <TopFrame />
        </header>

        <div class="flex flex-1 overflow-hidden">
            <aside id="app-sidebar" class="app-sidebar w-[250px] border-r transition-all duration-300 ease-in-out overflwo-y-auto overflow-x-hidden">
                <LeftMenu :menu-items="menuItems" />
            </aside>

            <main class="app-content flex flex-col flex-1 overflow-y-auto p-6 transition-all duration-300 ease-in-out bg-white">
                <slot></slot>
            </main>
        </div>
        
        <footer class="app-footer border-t">
            <BottomFrame />
        </footer>

        <BaseModal></BaseModal>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import TopFrame from '@/Components/layout/TopFrame.vue';
import LeftMenu from '@/Components/layout/LeftMenu.vue';
import BottomFrame from '@/Components/layout/BottomFrame.vue';
import BaseModal from '@/Components/BaseModal.vue';

const page = usePage();
const menuItems = computed(() => page.props.userMenu ?? []);
</script>