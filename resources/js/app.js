import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import AppLayout from './client/components/App.vue';
import '../assets/styles/globals.scss';
import '../assets/styles/app.css';
import setupI18n from './i18n'
createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./client/components/**/*.vue');
        return pages[`./client/components/${name}.vue`]().then((module) => {
            module.default.layout = module.default.layout || AppLayout;
            return module.default;
        });
    },
    setup({ el, App, props, plugin }) {
        const i18n = setupI18n(props.initialPage.props.locale, props.initialPage.props.translations)

        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18n)
            .mount(el);
    },
});
