<template>
<div align='right'>

	<button @click="fire" class="btn btn-default btn-icon bg-primary text-white">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22" class="fill-current">
			<path
				d="M17 7h2.25c.97 0 1.75.78 1.75 1.75v10.5c0 .97-.78 1.75-1.75 1.75H8.75C7.78 21 7 20.22 7 19.25V17H4.75C3.78 17 3 16.22 3 15.25V4.75C3 3.78 3.78 3 4.75 3h10.5c.97 0 1.75.78 1.75 1.75V7zm-2 0V5H5v10h2V8.75C7 7.78 7.78 7 8.75 7H15zM9 9v10h10V9H9z">
			</path>
		</svg>
	</button>

	<modal class="bg-none" v-if='showBox'>
		<div class="bg-white rounded-lg shadow-lg overflow-hidden" style="width: 460px;">
			<div class="p-8 text-left">
				<h2 class="mb-6 text-90 font-normal text-xl">{{ this.panel.fields[0].title ? this.panel.fields[0].title : 'Confirmation'}}</h2>
				<p class="text-80 leading-normal">{{ this.panel.fields[0].body ? this.panel.fields[0].body : 'Are you Sure ?'}}</p>
			</div>
			<div class="border-t border-50 px-6 py-3 ml-auto flex items-center" style="min-height: 70px; flex-direction: row-reverse;">
				<a @click="showBox=false" class="cursor-pointer btn text-80 font-normal px-3 mr-3 btn-link" style="order: 2;">
					{{ this.panel.fields[0].cancle_button_text ? this.panel.fields[0].cancle_button_text : 'Cancle' }}
				</a>
				<span>
					<span @click="proceed" class="nova-button nova-button-post cursor-pointer dim inline-block text-primary font-bold no-underline nova-button-post cursor-pointer dim inline-block text-primary font-bold no-underline"
						style="min-width: 80px;">
						{{ this.panel.fields[0].confirm_button_text ? this.panel.fields[0].confirm_button_text : 'Copy\\Clone'}}
					</span>
				</span>
			</div>
		</div>
	</modal>



</div>
</template>

<script>
import axios from "axios";

export default {
	props: ['resourceName', 'resourceId', 'panel'],
	// props: ["resourceName", "field"],


	mounted() {
		//
	},
	data() {
		return {
			showBox: false,
		}
	},
	methods: {
		fire() {
			this.showBox = true
		},
		proceed() {

			// this.$router.push('/resources/posts/10')

			axios
				.post("/nova-vendor/copy-clone/endpoint", {
					model: this.panel.fields[0].model ? this.panel.fields[0].model : "",
					id: this.panel.fields[0].id ? this.panel.fields[0].id : "",
					resource: this.panel.fields[0].resource ? this.panel.fields[0].resource : "",
					relations: this.panel.fields[0].relations ? this.panel.fields[0].relations : "",
					except: this.panel.fields[0].except ? this.panel.fields[0].except : "",
					override: this.panel.fields[0].override ? this.panel.fields[0].override : ""
				})
				.then(response => {
					window.location.replace(response.data.destination);
				})
				.catch(error => {
					console.log(error);
				});
		}
	}
}
</script>
