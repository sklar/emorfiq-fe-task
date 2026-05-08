// vite.config.js
import {defineConfig} from "vite";

export default defineConfig({
    server: {
        port: 5173,
        hmr: {
            port: 5173,
        }
    },
    build: {
        polyfillModulePreload: false,
        manifest: false,
        emptyOutDir: true,
        rollupOptions: {
            input: './assets/js/index.js',
            output: {
                dir: './dist/',
                entryFileNames: 'app.js',
                assetFileNames: 'app.css',
                chunkFileNames: "chunk.js",
                manualChunks: undefined,
            }
        },
    },
})