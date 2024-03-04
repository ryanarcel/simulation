<template>
  <div class="border mx-auto rounded shadow-2xl p-5 w-64 my-7">
    <h1 class="text-xl font-bold mb-2 h-16 flex items-center justify-center">{{ props.movie.Title }}</h1>
    <img :src="props.movie.Poster" alt="" class="mt-5">
    <FontAwesomeIcon :icon="faEnvelope" :style="{color: 'blue'}" @click="showMovieDetails()"/>
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

function showMovieDetails() {
  Swal.fire({
    title: props.movie.Title,
    text: props.movie.Plot,
    imageUrl: props.movie.Poster,
    imageWidth: 400,
    imageHeight: 200,
    imageAlt: 'Custom image',
  })
}

</script>

<style lang="scss" scoped></style>