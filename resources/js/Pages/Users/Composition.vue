<template>
	<div>
		<h3>Hi {{name}}</h3>
		<p>you are {{ age }} years old</p>
	</div>
</template>


<script>

import {ref, onMounted} from 'vue'

export default {

  props: {
    name: String,
    birthdate: String,
  },

  setup (props) {
    const age = ref(null)

    const getAge = () => {
			const today = new Date();
			const bdate = new Date(props.birthdate)

			let yearDifference = today.getFullYear() - bdate.getFullYear();

			if (today.getMonth() < bdate.getMonth() || (today.getMonth() === bdate.getMonth() && today.getDate() < bdate.getDate())) {
				yearDifference--;
			}

      age.value = yearDifference;
		}

    onMounted(() => {
      getAge()
    });

    return {
      age
    }
  }
}


</script>

<style lang="scss" scoped></style>