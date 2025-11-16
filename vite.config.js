import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/styles.css',
                'resources/js/map.js',
                'resources/css/cargar_inmueble.css',
                'resources/js/cargar_inmueble.js',
                'resources/css/detalle_inmueble.css',
                'resources/js/detalle_inmueble.js',
                'resources/css/filters.css',
                'resources/js/filters.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
    },
});