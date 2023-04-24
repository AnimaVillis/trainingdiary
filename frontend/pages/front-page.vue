 <template>
  <register-page />
  <menu-page />   
</template>

<script lang="ts">
import { defineComponent, reactive, ref } from 'vue'
import Register from './Register/Register.vue'
import Menu from './Menu/Menu.vue'


export default defineComponent({
    components: {
        'register-page': Register,
        'menu-page': Menu
    },

    setup() {
        return {}
    },
})
</script>