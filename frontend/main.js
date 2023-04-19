import App from "/app.vue";
import router from "/router";
import titleMixin from "/mixins/titleMixin";

import "/utils/swipefix.js";

import { createApp } from "vue";

const Vue = createApp(App);

Vue.use(router);
Vue.mixin(titleMixin);
Vue.mount("#app");
