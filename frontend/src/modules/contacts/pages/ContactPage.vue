<template>
  <v-container fluid>
		<v-row>
			<v-col>
				<div class="d-flex justify-center align-center">
					<div class="pa-4">
						<v-card width="350">
							<v-card-title>
								Contact Form:
							</v-card-title>
							<v-card-text>
								<create-contact-form
									:form="form"
									@after:submit="afterFormSubmit"
								></create-contact-form>
							</v-card-text>
						</v-card>
					</div>

					<div class="pa-4">
						<contact-lists
							:items="items"
							@edit:contact="editContact"
							@remove:contact="removeContact"
							@search:contact="getContacts({ search: $event })"
						></contact-lists>
					</div>
				</div>
			</v-col>
		</v-row>
		<!-- dialogs and snackbars -->
		<delete-contact-dialog
			v-model="deleteDialog.show"
			@close:dialog="deleteDialog.show = false"
			@delete:item="confirmDeleteContact"
		/>

		<snackbar
			v-model="snackbar.show"
			:text="snackbar.text"
			:color="snackbar.color"
		/>
  </v-container>
</template>

<script>
import { contactRepositoryApi } from '@/services/repositories'
export default {
	components: {
		CreateContactForm: () => import(/* webpackChunkName: "CreateContactForm" */ '../components/forms/CreateContactForm'),
		ContactLists: () => import(/* webpackChunkName: "ContactLists" */ '../components/lists/ContactLists'),
		DeleteContactDialog: () => import(/* webpackChunkName: "DeleteContactDialog" */ '../components/dialogs/DeleteContactDialog'),
		Snackbar: () => import(/* webpackChunkName: "Snackbar" */ '../components/partials/Snackbar')
	},
	data: () => ({
		items: [],
		form: {},
		deleteDialog: {
			dialog: false,
			form: {}
		},
		snackbar: {
			show: false,
			text: '',
			color: ''
		}
	}),
	methods: {
		async getContacts(params = {}) {
			await contactRepositoryApi.get({ params })
				.then(response => {
					let {
						data: {
							data: items
						}
					} = response

					this.items = items;
				})
				.catch(() => {
					this.items = []
				})
				.finally(() => {
				})
		},
		editContact(event) {
			this.form = JSON.parse(JSON.stringify(event));
		},
		removeContact(event) {
			this.deleteDialog = {
				show: true,
				form: event
			}

			this.form = {}
		},
		async confirmDeleteContact() {
			await contactRepositoryApi.delete(this.deleteDialog.form.id)
				.then(response => {
					this.snackbar = {
						show: true,
						text: response.data.message,
						color: 'success'
					}
				})
				.catch(error => {
					this.snackbar = {
						show: true,
						text: error.response.data.message,
						color: 'error'
					}
				})
				.finally(() => {
					this.deleteDialog = {
						show: false,
						form: {}
					}

					this.getContacts({})
				})
		},
		afterFormSubmit(event) {
			this.snackbar = {
				show: true,
				text: event.message,
				color: event.success ? 'success' : 'error'
			}

			this.form = {}

			this.getContacts({});
		}
	},
	created() {
		this.getContacts()
	}
}
</script>