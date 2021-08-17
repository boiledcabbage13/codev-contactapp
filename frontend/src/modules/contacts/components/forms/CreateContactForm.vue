<template>
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="form.name"
      :rules="requiredRules"
      label="Name"
      required
    ></v-text-field>

		<v-text-field
      v-model="form.email"
      :rules="[...requiredRules, ...emailRules]"
      label="E-mail"
      required
    ></v-text-field>

		<v-text-field
      v-model="form.contact_number"
      :rules="requiredRules"
      label="Contact Number"
      required
    ></v-text-field>

    <v-btn
      :disabled="!valid"
			:loading="loading"
      color="primary"
      class="mr-4 my-4"
      @click="submit"
    >
      Submit
    </v-btn>

		<v-btn
      color="error"
      class="mr-4"
      @click="reset"
    >
      Reset Form
    </v-btn>
  </v-form>
</template>

<script>
import { contactRepositoryApi } from '@/services/repositories'
export default {
	props: {
		form: {
			type: Object,
			default: () => {
				return {
					email: '',
					contact_number: '',
					name: ''
				}
			}
		}
	},
	data: () => ({
		valid: true,
		emailRules: [
			v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
		],
		requiredRules: [
			v => !!v || 'This field is required',
		],
		loading: false
	}),

	methods: {
		validate () {
			return this.$refs.form.validate()
		},
		reset () {
			this.$refs.form.reset()
		},
		submit() {
			let valid = this.validate();

			if (valid) {
				if (this.form.id) {
					this.update()
				} else {
					this.create()
				}
			}
		},
		async create() {
			console.log('create')
			this.loading = true

			await contactRepositoryApi.create(this.form)
				.then(response => {
					let {
						data
					} = response

					this.$emit('after:submit', {
						data: data.data,
						message: data.message,
						success: true
					})
				})
				.catch(error => {
					this.$emit('after:submit', {
						data: null,
						message: error.response.data.message,
						success: false
					})
				})
				.finally(() => {
					this.loading = false
					this.reset()
				}) 
		},
		async update() {
			console.log('update')
			this.loading = true

			await contactRepositoryApi.update(this.form.id, this.form)
				.then(response => {
					let {
						data
					} = response

					this.$emit('after:submit', {
						data: data.data,
						message: data.message,
						success: true
					})
				})
				.catch(error => {
					this.$emit('after:submit', {
						data: null,
						message: error.response.data.message,
						success: false
					})
				})
				.finally(() => {
					this.loading = false
					this.reset()
				}) 
		}
	},
}
</script>