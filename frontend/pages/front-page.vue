 <template>
  <login-page />
  <menu-page />   
</template>

<script lang="ts">
import { defineComponent, reactive, ref } from 'vue'
import Login from './Login/Login.vue'
import Menu from './Menu/Menu.vue'


export default defineComponent({
    components: {
        'login-page': Login,
        'menu-page': Menu
    },

    setup() {
        return {}
    },
})
</script>