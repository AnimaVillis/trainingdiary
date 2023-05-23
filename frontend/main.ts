import App from "./src/app.vue";
import router from "./src/router";
import "./index.css";
import "./src/utils/swipefix";



import { createApp } from "vue";

const Vue = createApp(App);

Vue.use(router);
Vue.mount("#app");
