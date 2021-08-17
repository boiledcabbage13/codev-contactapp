<template>
  <v-card
    class="mx-auto"
    max-width="700"
  >
    <v-toolbar
      color="primary"
    >
      <v-toolbar-title>
				<span class="white--text">{{ title }}</span>
			</v-toolbar-title>

      <v-spacer></v-spacer>

			<v-text-field
				solo
				label="Search..."
				prepend-inner-icon="mdi-magnify"
				hide-details
				v-model="search"
        dense
				@click:prepend-inner="$emit('search:contact', search)"
        class="ml-4"
			></v-text-field>
    </v-toolbar>

    <v-list two-line>
      <v-list-item-group>
        <template v-if="items.length <= 0">
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>No contacts</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
        <template v-else v-for="(item, index) in items">
          <v-list-item :key="index">
            <template>
              <v-list-item-content>
                <v-list-item-title v-text="item.name"></v-list-item-title>

                <v-list-item-subtitle
                  v-text="item.email"
									class="subtitle-1"
                ></v-list-item-subtitle>

								<v-list-item-subtitle
                  v-text="item.contact_number"
									class="font-weight-bold"
                ></v-list-item-subtitle>
              </v-list-item-content>

              <v-list-item-action>
                <v-icon
                  color="grey lighten-1"
									@click="$emit('edit:contact', item)"
                >
                  mdi-pencil
                </v-icon>

                <v-icon
                  color="error"
									@click="$emit('remove:contact', item)"
                >
                  mdi-trash-can-outline
                </v-icon>
              </v-list-item-action>
            </template>
          </v-list-item>

          <v-divider
            v-if="index < items.length - 1"
            :key="`${item.id}-${index}`"
          ></v-divider>
        </template>
      </v-list-item-group>
    </v-list>
  </v-card>
</template>

<script>
  export default {
		props: {
			items: {
				type: Array,
				default: () => []
			}
		},
    data: () => ({
			title: 'Contact Lists',
			search: ''
    }),
  }
</script>