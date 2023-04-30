import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

const defaultConfig = {
  mode: "jit",
  plugins: [vue()],
  base: "/",
  build: {
    write: true,
    manifest: true,
  },
  transpile: [/@vue[\\/]composition-api/],
  server: {
    watch: {
      usePolling: true,
    },
    cors: true,
    strictPort: true,
    port: 3000,
    proxy: {
      "^/api/": {
        target: "http://localhost:3001",
        ws: true,
        changeOrigin: true,
      },
    },
  },
};

export default defineConfig(({ command }) => {
  if (command === "serve") {
    return {
      ...defaultConfig,
    };
  } else {
    return {
      ...defaultConfig,
      base: "/dist/",
    };
  }
});
