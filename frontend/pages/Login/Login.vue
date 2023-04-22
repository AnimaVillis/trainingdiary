 <template>
    <section class="grid h-screen place-content-center bg-slate-900 text-slate-300">
        <div class="mb-10 text-center text-orange-400">
            <h1 class="text-3xl font-bold tracking-widest">SIGN UP</h1>
            <span>Don't have an account yet? Sign up here!</span>
        </div>
            <form class="flex flex-col items-center justify-center space-y-6">
                <input
                    v-model="form.username"
                    type="text" 
                    name="uid" 
                    placeholder="Username" 
                    class="w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500"
                />
                <input 
                    v-model="form.password"
                    type="password" 
                    id="password" 
                    name="pwd" 
                    placeholder="Password" 
                    class="w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" 
                />
                <input 
                    v-model="form.password_confirm"
                    type="password" 
                    id="confirm_password" 
                    name="pwdrepeat" 
                    placeholder="Confirm Password" 
                    class="w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" 
                />
                <input 
                    v-model="form.email"
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="E-mail" 
                    class="w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" 
                />
                <button 
                    type="submit" 
                    class="rounded-full bg-orange-500 p-2 px-4 text-white hover:bg-indigo-500"
                    @click="submit"
                >SIGN UP</button>
            </form>
    </section>
</template>

<script lang="ts">
import { defineComponent, reactive, ref } from 'vue'

interface Form {
    username: string,
    password: string,
    password_confirm: string,
    email: string
}

export default defineComponent({
    setup() {
        const form = reactive<Form>({
            username: '',
            password: '',
            password_confirm: '',
            email: ''
        })

        const name = ref('Anna');

        function submit() {
            console.log('submit');
        }

        return {
            form,
            name,
            submit
        }
        
    },
})
</script>