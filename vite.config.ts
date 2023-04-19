import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

const defaultConfig = {
  mode: "jit",
  plugins: [vue()],
  base: "/",
  root: "frontend/",
  build: {
    write: true,
    publicDir: "./frontend/public/",
    manifest: true,
  },
  server: {
    watch: {
      usePolling: true,
    },
    cors: true,
    strictPort: true,
    port: 3000,
    proxy: {
      "^/api/": {
        target: "http://localhost:81",
        ws: true,
        changeOrigin: true
      },
    },
  },
};

export default defineConfig(({ command }) => {
  if (command === "serve") {
    return {
      ...defaultConfig
    };
  } else {
    return {
      ...defaultConfig,
      base: "/dist/",
    };
  }
});
