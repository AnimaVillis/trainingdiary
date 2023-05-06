<template>
  <register-page />
  <menu-page />
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Register from "../components/Register.vue";
import Menu from "../components//Menu.vue";

export default defineComponent({
  components: {
    "register-page": Register,
    "menu-page": Menu,
  },
});
</script>

<style lang="postcss">
.form_input {
  @apply w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500;
}
</style>
