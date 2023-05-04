<template>
  <register-page />
  <!-- @TODO temporary false -->
  <menu-page v-if="false"/>
  <settings-page />
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Register from "./Register/Register.vue";
import Menu from "./Menu/Menu.vue";
import Settings from "./Settings/Settings.vue"

export default defineComponent({
  components: {
    "register-page": Register,
    "menu-page": Menu,
    "settings-page": Settings
  },
});
</script>
