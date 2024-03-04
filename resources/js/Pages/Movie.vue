<template>
  <div class="border mx-auto rounded shadow-2xl p-5 w-64 my-7">
    <h1 class="text-xl font-bold mb-2 h-16 flex items-center justify-center">{{ props.movie.Title }}</h1>
    <img :src="props.movie.Poster" alt="" class="mt-5">
    <FontAwesomeIcon :icon="faEnvelope" :style="{ color: 'blue' }" @click="showFormAlert()" />
  </div>
</template>

<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faEnvelope } from '@fortawesome/free-solid-svg-icons'
import { ref, defineProps } from 'vue'
import Swal from 'sweetalert2'

const props = defineProps({
  movie: Object
})

function showFormAlert() {
  const { value: formValues } = Swal.fire({
    title: 'Enter your details',
    html:
      '<input id="swal-input1" class="swal2-input" placeholder="Name">' +
      '<input id="swal-input2" class="swal2-input" placeholder="Email">',
    focusConfirm: false,
    preConfirm: () => {
      return [
        document.getElementById('swal-input1').value,
        document.getElementById('swal-input2').value
      ];
    }
  });

  if (formValues) {
    Swal.fire(`Name: ${formValues[0]}, Email: ${formValues[1]}`);
  }
}

</script>

<style lang="scss" scoped></style>