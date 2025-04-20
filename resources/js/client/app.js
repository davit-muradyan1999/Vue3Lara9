import { createApp } from 'vue';
import './../../assets/styles/globals.scss';

import {ZiggyVue} from '../../../vendor/tightenco/ziggy';
import route from 'ziggy-js';

import App from './components/App.vue';

const app = createApp(App);

app.config.globalProperties.route = (name, params, absolute) =>
    route(name, params, absolute, ZiggyVue);

app.mount('#app');
