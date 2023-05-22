<template>
<section class="grid place-content-center bg-slate-900">
			<h2
				class="uppercase m-6 text-center text-3xl font-bold tracking-widest text-orange-400">
				Profile
			</h2>
			<form action="" method="post" class="grid place-items-center gap-6">
				<p class="text-orange-400">Name:</p>
				<input
					v-model="form.name"
					type="text"
					name="uid"
					placeholder="Name"
					class="w-64 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 text-slate-300 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" />
				<p class="text-orange-400">Surname:</p>
				<input
					v-model="form.surname"
					type="text"
					name="uid"
					placeholder="Surname"
					class="w-64 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 text-slate-300 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" />
				<p class="text-orange-400">Gender:</p>
				<section class="flex gap-14">
					<div>
						<p class="inline-block mr-2
            text-orange-400">male:</p>
						<div class="toggle relative inline-block">
							<input type="checkbox" class="absolute left-0 top-2 w-full h-full opacity-0 z-10 cursor-pointer"/>
							<label class="flex relative items-center"></label>
						</div>
					</div>
					<div>
						<p class="inline-block mr-2 text-orange-400">female:</p>
						<div class="toggle relative inline-block">
							<input type="checkbox" class="absolute left-0 top-2 w-full h-full opacity-0 z-10 cursor-pointer"/>
							<label class="flex relative items-center"></label>
						</div>
					</div>
				</section>
				<p class="text-orange-400">Weight:</p>
				<input
					v-model="form.weight"
					type="text"
					name="uid"
					placeholder="Weight"
					class="w-64 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 text-slate-300 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" />
				<p class="text-orange-400">Height:</p>
				<input
					v-model="form.height"
					type="text"
					name="uid"
					placeholder="Height"
					class="w-64 appearance-none rounded-full border-0 bg-slate-800/50 p-2 px-4 text-slate-300 focus:bg-slate-800 focus:ring-2 focus:ring-orange-500" />
				<button
					type="submit"
					class="btn-submit col-span-2 justify-self-end mr-5 rounded-full bg-orange-500 p-2 px-4 text-white uppercase hover:bg-indigo-500"
					@click="submit">
					Submit
				</button>
			</form>
		</section>
</template>
    
<script>
  import { ref } from 'vue';
  
  export default {
    components: {
    },

    setup() {
      return {

      };
    }
    };
</script>
<style>
			.toggle label:before {
				content: '';
				position: relative;
                top: 2px;
				display: inline-block;
				width: 40px;
				height: 20px;
				background-color: rgb(249, 115, 22);
				border: 2px solid #e2e2e2;
				box-shadow: inset -20px 0 0 #e2e2e2;
				border-radius: 20px;
				box-sizing: border-box;
				transition: 0.25s ease-in-out;
			}

			.toggle input[type='checkbox']:checked + label:before {
				box-shadow: inset 20px 0 0 rgb(99, 102, 241);
			}
				</style>
				