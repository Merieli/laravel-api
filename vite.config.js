import tailwindcss from "@tailwindcss/vite";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [
                'resources/routes/**',
                'routes/**',
                'resources/views/**',
            ],
        }),
        tailwindcss(),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
        host: "0.0.0.0",
        port: 5173,
        watch: {
            usePolling: true,
        },
    },
});
