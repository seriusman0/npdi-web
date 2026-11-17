import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

// VITE_BUILD_DIR dipakai saat deploy: build ke direktori sementara (relatif
// terhadap public/), lalu ditukar dengan public/build dalam satu langkah rename.
// Default tetap public/build.
const buildDirectory = process.env.VITE_BUILD_DIR || 'build';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
