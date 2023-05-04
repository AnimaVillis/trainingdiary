<template>
  <about-page />        
</template>
    
<script>
  import { ref } from 'vue';
  import About from '../Settings/About/About.vue';
    
  export default {
    components: {
        'about-page': About
    },

    setup() {
      return {

      };
    }
  };
</script>