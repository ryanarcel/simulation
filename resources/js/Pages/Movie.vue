<template>
  <div class="block border mx-auto rounded shadow-2xl p-5 w-64 my-7 hover:bg-gray-300">
    <h1 class="text-xl font-bold mb-2 h-16 flex items-center justify-center text-center">{{ props.movie.Title }}</h1>
    <img :src="props.movie.Poster" alt="" class="mt-5">
    <div class="flex justify-center">
      <i :class="[likeValue ? 'fas' : 'far', 'mx-2 fa-thumbs-up text-2xl text-greenBlue mt-5 cursor-pointer hover:text-yellow']" @click="likeMovie()"></i>
      <i :class="[dislikeValue ? 'fas' : 'far', 'mx-2 fa-thumbs-down text-2xl text-validationRed mt-5 cursor-pointer hover:text-yellow']" @click="showFormAlert"></i>
      <i :class="[commentValue ? 'fas' : 'far', 'mx-2 fa-comment text-2xl text-pumpkin mt-5 cursor-pointer hover:text-yellow']" @click="showFormAlert"></i>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps } from 'vue'
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  movie: Object
})

const likeValue = ref(false);
const dislikeValue = ref(false);
const commentValue = ref(false);

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

function likeMovie () {
  const data = {
    movie_id: props.movie.imdbID,
    title: props.movie.Title,
    like: likeValue.value ? 0 : 1,
  }
  router.post(route('likeMovie'), data, { preserveScroll: true })
}

</script>

<style scoped></style>