<style>
			* {
				margin: 0;
				padding: 0;
				box-sizing: border-box;
			}

			.grid {
				display: grid;
				font-family: 'sans-serif';
				background-color: rgb(15 23 42);
				/* color: rgb(249, 115, 22); */
			}

			.customer-data {
				padding: 30px 0;
				/* text-align: center; */
				font-size: 26px;
				/* text-transform: uppercase; */
				letter-spacing: 2px;
			}

			.grid-date {
				display: grid;
				grid-template: 1fr 1fr / minmax(50px, 90px) auto;
				justify-items: start;
				align-items: center;
				row-gap: 25px;
				margin: 0 auto;
			}

			.input-btn {
				padding: 8px 16px;
				border-radius: 40px;
				border-width: 0px;
				font-size: 100%;
			}

			.bg-c {
				background-color: rgba(30, 41, 59, 0.502);
			}

			.flex {
				/* display: flex; */
				column-gap: 4px;
			}

			.toggle {
				position: relative;
			}

			.toggle input[type='checkbox'] {
				position: absolute;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				opacity: 0;
				z-index: 5;
				cursor: pointer;
			}

			.toggle label {
				display: flex;
				position: relative;
				align-items: center;
			}

			.toggle label:before {
				content: '';
				position: relative;
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

			.flex .left {
				margin-left: 12px;
			}

			.btn-submit {
				grid-column: 1 / 3;
				margin-right: 40px;
				justify-self: end;
				color: white;
				background-color: rgb(249, 115, 22);
				/* text-transform: uppercase; */
				cursor: pointer;
			}

			.btn-submit:hover {
				background-color: rgb(99, 102, 241);
			}
		</style>

<template>
 <section class="grid text-orange-400">
			<h2 class="customer-data uppercase text-center">Profile</h2>
			<form action="" method="post" class="grid-date">
				<p>Name:</p>
				<input
					v-model="form.name"
					type="text"
					name="uid"
					placeholder="Name"
					class="input-btn bg-c" />
				<p>Surname:</p>
				<input
					v-model="form.surname"
					type="text"
					name="uid"
					placeholder="Surname"
					class="input-btn bg-c" />
				<p>Gender:</p>
				<section class="flex">
					<p>male:</p>
					<div class="toggle">
						<input type="checkbox" />
						<label></label>
					</div>
					<p class="left">female:</p>
					<div class="toggle">
						<input type="checkbox" />
						<label></label>
					</div>
				</section>
				<p>Weight:</p>
				<input
					v-model="form.weight"
					type="text"
					name="uid"
					placeholder="Weight"
					class="input-btn bg-c" />
				<p>Height:</p>
				<input
					v-model="form.height"
					type="text"
					name="uid"
					placeholder="Height"
					class="input-btn bg-c" />
				<button type="submit" class="btn-submit input-btn uppercase" @click="submit">
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