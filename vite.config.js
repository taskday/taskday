import path from "path";
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import Components from "unplugin-vue-components/vite";

export default defineConfig({
  plugins: [
    vue(),
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
