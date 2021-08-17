<template>
	<v-snackbar
		v-bind="$attrs"
		v-on="$listeners"
		:timeout="2000"
	>
		{{ text }}
	</v-snackbar>
</template>

<script>
export default {
	props: {
		text: {
			type: String,
			default: ''
		}
	}
}
</script>