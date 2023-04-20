 <template>
    <section class="grid h-screen place-content-center bg-slate-900 text-slate-300">
        <div class="mb-10 text-center text-orange-400">
            <h1 class="text-3xl font-bold tracking-widest">SIGN UP</h1>
            <p>Don't have an account yet? <span class="font-bold">Sign up here!</span></p>
        </div>
            <form action="../backend/includes/signup.inc.php" method="post" class="flex flex-col items-center justify-center space-y-6">
                <input type="text" name="uid" placeholder="Username" class="w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500">
                <input type="password" id="password" name="pwd" placeholder="Password" class="w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" />
                <input type="password" id="confirm_password" name="pwdrepeat" placeholder="Confirm Password" class="w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" />
                <input type="email" id="email" name="email" placeholder="E-mail" class="w-80 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" />
                <button type="submit" name="submit" class="rounded-full bg-orange-500 p-2 px-4 text-white hover:bg-indigo-500">SIGN UP</button>
            </form>
    </section>
    <section class="grid place-content-center bg-slate-900 text-slate-300">
        <div class="mb-10 text-center text-orange-400">
            <h1 class="text-3xl font-bold tracking-widest">LOGIN</h1>
            <p>Have an account? <span class="font-bold">Login here!</span></p>
        </div>
            <form action="../backend/includes/signup.inc.php" method="post" class="flex flex-col items-center justify-center space-y-6">
                <input type="text" name="uid" placeholder="Username" class="form_input">
                <input type="password" id="password" name="pwd" placeholder="Password" class="form_input"/>
                <button type="submit" name="submit" class="rounded-full bg-orange-500 p-2 px-4 text-white hover:bg-indigo-500">LOGIN</button>
            </form>
    </section>
</template>
