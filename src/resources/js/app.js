import './bootstrap';

import { createApp } from 'vue';

// Import components
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});

// Register components
app.component('example-component', ExampleComponent);

app.mount('#app');

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('app-sidebar');
    const toggleButton = document.getElementById('sidebar-toggle');
    const sidebarStateKey = 'sidebar-collapsed';

    if (!sidebar || !toggleButton) {
        console.error('Required elements for sidebar toggle not found.');
        return;
    }

    // Function to apply the collapsed state by toggling a class
    const applySidebarState = (isCollapsed) => {
        sidebar.classList.toggle('collapsed', isCollapsed);
    };

    // Check localStorage and apply state on page load
    const isCollapsed = localStorage.getItem(sidebarStateKey) === 'true';
    applySidebarState(isCollapsed);

    // Add click event listener to the toggle button
    toggleButton.addEventListener('click', () => {
        const currentState = sidebar.classList.contains('collapsed');
        const newState = !currentState;
        localStorage.setItem(sidebarStateKey, newState);
        applySidebarState(newState);
    });
});
