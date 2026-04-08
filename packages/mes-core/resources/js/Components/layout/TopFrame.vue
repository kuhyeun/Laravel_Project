<template>
    <div class="flex items-center h-[50px] px-5 py-3 font-bold">
        <div class="top-left-content flex items-center">
            <button id="sidebar-toggle" class="p-1 mr-2 border border-transparent rounded-md box-border hover:border-black" @click="toggleSidebar">
                <Bars3BottomLeftIcon class="h-5 w-5" />
            </button>
            <h1 class="top-frame-title">{{ title }}</h1>
        </div>
        <div class="flex-1"></div>
        <div class="flex items-center space-x-4">
            <button id="user-info mr-2">
                <InformationCircleIcon class="h-5 w-5 fill-gray-700"/>
            </button>
            <Link :href="route('user.dashboard')" class="text-gray-700 hover:text-blue-500">DashBoard</Link>
            <Link :href="route('user.dashboard2')" class="text-gray-700 hover:text-blue-500">DashBoard2</Link>
            <a :href="route('user.logout')" class="text-gray-700 hover:text-blue-500">Logout</a>
        </div>
    </div>
</template>

<script setup>
import { route } from 'ziggy-js';
import { storeToRefs } from 'pinia';
import { useUiStore } from '../../Stores/uiStore';
import { Link } from '@inertiajs/vue3';
import { Bars3BottomLeftIcon, InformationCircleIcon } from '@heroicons/vue/24/solid';

const uiStore = useUiStore();
const { title } = storeToRefs(uiStore);

const toggleSidebar = () => {
    const sidebarStateKey = 'sidebar-collapsed';
    const isCollapsed = document.documentElement.classList.toggle( 'sidebar-collapsed' );

    localStorage.setItem( sidebarStateKey, isCollapsed );
};
</script>