import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    base: '/build/',
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        vue(),
    ],
});
