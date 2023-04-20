import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(),
  linkActiveClass: "active",
  scrollBehavior() {
    return { top: 0 };
  },
  routes: [
    { 
      path: "/",
      component: () => import("./pages/front-page.vue") 
    },
    { 
      path: "/login", 
      component: () => import("./pages/login.vue") },

    // Not found
    {
      path: "/:catchAll(.*)",
      component: () => import("./pages/error-404.vue"),
    },
  ],
});

export default router;
