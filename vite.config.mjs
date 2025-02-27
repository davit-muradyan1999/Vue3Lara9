import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/admin.js',  // Для админки
                'resources/js/client/app.js' // Для клиентской части на Vue
            ],
            refresh: true,
        }),
        vue(),
    ],
});
