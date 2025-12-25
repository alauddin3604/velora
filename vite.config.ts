import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173,
        https: {
            key: '/certs/cert.key',
            cert: '/certs/cert.crt',
        },
        hmr: {
            host: 'localhost',
            protocol: 'wss',
            clientPort: 5173,
        },
        cors: {
            origin: ['https://velora.lndo.site', 'http://velora.lndo.site'],
            credentials: true,
        },
    },
    resolve: {
        alias: {
            'ziggy-js': path.resolve(__dirname, 'vendor/tightenco/ziggy'),
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        })
    ],
})
