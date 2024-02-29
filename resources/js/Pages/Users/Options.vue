<template>
	<div>
		<h3>Hi {{this.name}}</h3>
		<p>you are {{ this.age }} years old</p>
	</div>
</template>
<script>
export default {
	data() {
		return {
			age: null,
		}
	},
	props: {
		name: String,
		birthdate: String,
	},
	methods: {
		getAge () {
			const today = new Date();
			const bdate = new Date(this.birthdate)

			let yearDifference = today.getFullYear() - bdate.getFullYear();

			if (today.getMonth() < bdate.getMonth() || (today.getMonth() === bdate.getMonth() && today.getDate() < bdate.getDate())) {
				yearDifference--;
			}

			this.age = yearDifference;
		}
	},
	mounted() {
		this.getAge()
	}
}
</script>
<style lang="">
    
</style>