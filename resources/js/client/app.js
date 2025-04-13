import { createApp } from 'vue';
import './../../assets/styles/globals.scss';

import { Ziggy } from '@/ziggy'; // путь может быть другим
import route from 'ziggy-js';

import App from './components/App.vue';

const app = createApp(App);

app.config.globalProperties.route = (name, params, absolute) =>
    route(name, params, absolute, Ziggy);

app.mount('#app');
