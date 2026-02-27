import './bootstrap';

import { createApp } from 'vue';

// Import components
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});

// Register components
app.component('example-component', ExampleComponent);

app.mount('#app');
