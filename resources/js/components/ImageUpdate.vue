<template>
	<div>
		<div v-for="(image, i) in images" class="col-12 col-sm-12" style="border:1px solid #ddd">
			<div class="row">
				<div class="col-8 col-sm-6"><input v-if="!image.name" type="hidden" name="img[]" v-bind:value="image.src"><img v-bind:src="image.src" alt="your image" style="height:65px; max-width:100px; min-width:50px"/></div>
				<div class="col-2 col-sm-3 text-danger">
					<a href="#" v-on:click.prevent="deleteImage(i)"><i class="fa fa-close text-danger" style="font-size:36px;line-height: 65px; height:65px; text-align:center"></i></a>
				</div>
				<div class="col-2 col-sm-3" style="position:relative">
					<a v-if="i>0" href="#" v-on:click.prevent="imageInterchange(i-1, i)"><i class="fa fa-angle-up" style="font-size:36px; position:absolute; top:0; line-height:20px;"></i></a>
					<a v-if="i<(images.length-1)" href="#" v-on:click.prevent="imageInterchange(i, i+1)"><i class="fa fa-angle-down" style="font-size:36px; position:absolute; bottom:0; line-height:20px;"></i></a>
				</div>
			</div>
		</div>
		<div class="form-group" id="file-button" v-bind:class="{'d-none': images.length == number_of_image}">
			<label for="main_img">Add new photo</label>
			<input type="hidden" name="image_serial" v-model="serial">
			<input v-for="i in serial" class="form-control d-none btn btn-primary btn-theme bg-theme" v-bind:class="{'d-inline-block': (d == i) || (d == -1 && images.length == i), 'required': (i == 0) && is_first_required}" @change="processFile($event)" type="file" name="images[]">
		</div>
	</div>
</template>

<script>
    export default {
		data() {
			return {
				images: JSON.parse(this.stored_images),
				serial: [],
				d:-1, /* d for deleted index */
				is_first_required: 1, /* 0 => if the first image is not required*/
				number_of_image: 36 /* minimum value is one */
			}
		},
		methods: {
			init(){
				for(let i = 0; i<this.number_of_image; i++) {
					this.serial[i] = i;
				}
			},
			processFile(event) {
				var f = event.target.files[0];
				f.src = URL.createObjectURL(event.target.files[0]);
				this.images.push(f);
				this.d = -1;
			},
			imageInterchange(i, j) {
				var s = this.serial[i];
				this.serial[i] = this.serial[j];
				this.serial[j] = s;
				var image = this.images[i];
				this.images.splice(i, 1);
				this.images.splice(j, 0, image);
			},
			deleteImage(i) {
				this.images.splice(i, 1);
				this.d = i;
				var files = document.getElementById('file-button').querySelectorAll('input[type="file"]');
				files[i].value = "";
			}
		},
		created() {
			this.init();
		},
		props: ['stored_images']
    }
</script>
<style scoped>
	.d-inline-block {
	
	}
	.has-error {
		border:1px solid #a94442;
	}
</style>