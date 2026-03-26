import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';

// Import components
import ExampleComponent from '@/components/ExampleComponent.vue';
import BaseModal from '@/components/BaseModal.vue'; // BaseModal 추가
import LandingPage from '@/pages/landing/LandingPage.vue';

const app = createApp({});
const pinia = createPinia(); // Pinia 인스턴스 생성

app.use(pinia); // 앱에 Pinia 등록

// Register components
app.component('example-component', ExampleComponent);
app.component('base-modal', BaseModal); // BaseModal 전역 등록
app.component('landing-page', LandingPage);

app.mount('#app');

document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById( 'sidebar-toggle' );
    const sidebarStateKey = 'sidebar-collapsed';

    if( !toggleButton ) {
        console.error( 'Sidebar toggle button not found.' );
        return;
    };

    toggleButton.addEventListener('click', () => {
        const isCollapsed = document.documentElement.classList.toggle( 'sidebar-collapsed' );

        localStorage.setItem( sidebarStateKey, isCollapsed );
    });
});
