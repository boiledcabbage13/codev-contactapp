<template>
  <v-dialog
    v-bind="$attrs"
    v-on="$listeners"
    max-width="290"
    persistent
  >
    <v-card>
      <v-card-title class="text-h5">
        Delete Contact
      </v-card-title>

      <v-card-text>
        Are you sure you want to delete this contact?
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn color="error" @click="$emit('close:dialog')">
          Cancel
        </v-btn>

        <v-btn color="primary" @click="$emit('delete:item')">
          Submit
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>