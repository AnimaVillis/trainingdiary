import App from "./app.vue";
import router from "./router";
import "./index.css";
import "/utils/swipefix.js";

import { createApp } from "vue";

const Vue = createApp(App);

Vue.use(router);
Vue.mount("#app");
