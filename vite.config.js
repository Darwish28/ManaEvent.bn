import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from 'tailwindcss';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',   // for customer site
        'resources/js/main.tsx', // for admin React app
      ],
      refresh: true,
    }),
    react(),
    tailwindcss(),
  ],
});
