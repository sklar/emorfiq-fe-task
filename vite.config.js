import { defineConfig } from 'vite';
import { hotFile } from './vite-plugin-hot-file.js';

export default defineConfig({
    plugins: [hotFile()],
    css: {
        // LightningCSS replaces the default PostCSS pipeline + esbuild minifier:
        // one Rust pass for autoprefixing (driven by .browserslistrc) plus
        // modern-syntax targeting/lowering. Faster, smaller output.
        transformer: 'lightningcss',
    },
    build: {
        // manifest.json is required by templates/vite.php to resolve hashed
        // asset filenames in production (when public/hot is absent).
        manifest: true,
        cssMinify: 'lightningcss',
        rollupOptions: {
            // SCSS is the direct entry — there is no JS in this project.
            input: './assets/scss/index.scss',
        },
    },
});
