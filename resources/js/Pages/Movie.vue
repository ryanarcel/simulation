<template>
  <div class="block border mx-auto rounded shadow-2xl p-5 w-64 my-7 hover:bg-gray-100">
    <h1 class="text-md font-bold mb-2 h-16 flex items-center justify-center text-center">{{ props.movie.Title }}</h1>
    <img :src="props.movie.Poster !== 'N/A' ? props.movie.Poster : 'https://placehold.co/400x600'" alt="" class="mt-5">
    <div class="flex justify-center">
      <i :class="[likeStatus ? 'fas text-greenBlue' : 'far', 'mx-2 fa-thumbs-up text-2xl text-gray-500 mt-5 cursor-pointer hover:text-greenBlue']"
        @click="likeMovie()"></i>
      <i :class="[dislikeStatus ? 'fas text-validationRed' : 'far', 'mx-2 fa-thumbs-down text-2xl text-gray-500 mt-5 cursor-pointer hover:text-validationRed']"
        @click="showFormAlert"></i>
      <i :class="[commentStatus ? 'fas text-pumpkin' : 'far', 'mx-2 fa-comment text-2xl text-gray-500 mt-5 cursor-pointer hover:text-pumpkin']"
        @click="showFormAlert"></i>
    </div>
  </div>
</template>

<script setup>
import { ref, defineEmits, computed, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const emit = defineEmits(['like-movie'])

const props = defineProps({
  movie: Object,
  liked: Boolean,
})

const likeStatus = ref(false);
const dislikeStatus= ref(false);
const commentStatus= ref(false);


async function checkIfLiked (imdbID) {
  const response = await axios.get(route('checkIfLiked', { imdbID }));
  likeStatus.value = response.data.liked;
}

function likeMovie () {
  const data = {
    movie_id: props.movie.imdbID,
    title: props.movie.Title,
    like: likeStatus.value ? 0 : 1,
  }
  emit('like-movie', data)
}

onMounted(() => {
  checkIfLiked(props.movie.imdbID)
})

</script>

<style scoped></style>