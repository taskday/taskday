import path from "path";
import fs from 'fs';
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import Components from "unplugin-vue-components/vite";
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
  server: {
    https: {
      key: fs.readFileSync('./.cert/key.pem'),
      cert: fs.readFileSync('./.cert/cert.pem'),
    },
    hmr: {
      protocol: 'wss',
      host: 'localhost',
    }
  },
  plugins: [
    vue(),
    VitePWA({
      start_url: '/',
      filename: "sw.ts",
      includeAssets: ["*.svg"],
      includeManifestIcons: false,
      injectRegister: false,
      injectManifest: false,
      manifest: {
        name: "Taskday",
        short_name: "Taskday",
        description: "Taskday",
        theme_color: "#ced4da",
        icons: [
          {
            src: "../favicons/192.png",
            sizes: "192x192",
            type: "image/png",
          },
          {
            src: "../favicons/512.png",
            sizes: "512x512",
            type: "image/png",
          }
        ],
      },
      srcDir: "resources/service-worker",
      strategies: 'generateSW',
      devOptions: {
        enabled: process.env.SW_DEV === "true",
        type: "module",
      },
    }),
    laravel({
      input: ["resources/app.ts"],
      refresh: true,
    }),
    Components({
      dirs: ["./resources/components"],
      extensions: ["vue"],
    }),
  ],
  resolve: {
    alias: {
      "@": path.resolve(__dirname + "/resources"),
    },
  },
});
