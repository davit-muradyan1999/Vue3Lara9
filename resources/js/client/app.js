import { createApp } from 'vue';
import './../../assets/styles/globals.scss'
import { route } from 'ziggy-js';
import App from './components/App.vue';

createApp(App).use(route).mount('#app');
