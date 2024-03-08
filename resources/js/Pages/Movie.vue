<template>
  <div class="block border mx-auto rounded shadow-2xl p-5 w-64 my-7 hover:bg-gray-100">
    <h1 class="text-md font-bold flex justify-center text-center">{{ props.movie.Title }}</h1>
    <p class="text-sm text-gray-600 text-center">{{ props.movie.Year }}</p>
    <img :src="props.movie.Poster !== 'N/A' ? props.movie.Poster : 'https://placehold.co/400x600'" alt="" class="mt-5">
    <div class="flex justify-center">
      <i :class="[likeStatus ? 'fas text-greenBlue' : 'far', 'mx-2 fa-thumbs-up text-2xl text-gray-500 mt-5 cursor-pointer hover:text-greenBlue']"
        @click="likeMovie()"></i>
      <i :class="[dislikeStatus ? 'fas text-validationRed' : 'far', 'mx-2 fa-thumbs-down text-2xl text-gray-500 mt-5 cursor-pointer hover:text-validationRed']"
        @click="dislikeMovie()"></i>
      <i :class="[commentStatus ? 'fas text-pumpkin' : 'far', 'mx-2 fa-comment text-2xl text-gray-500 mt-5 cursor-pointer hover:text-pumpkin']"
        @click="showFormAlert"></i>
    </div>
  </div>
</template>

<script setup>
import { ref, defineEmits, computed, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

const emit = defineEmits([
  'like-movie',
  'dislike-movie'
])

const props = defineProps({
  movie: Object,
  liked: Boolean,
})

const likeStatus = ref(false);

async function checkIfLiked (imdbID) {
  await axios.get(route('checkIfLiked', { imdbID })).then((response) => {
    likeStatus.value = response.data.liked;
  })
}

function likeMovie () {
  const data = {
    movie_id: props.movie.imdbID,
    title: props.movie.Title,
    like: likeStatus.value ? 0 : 1,
  }
  emit('like-movie', data)
  checkIfLiked(props.movie.imdbID)
}

const dislikeStatus= ref(false);

async function checkIfDisliked (imdbID) {
  await axios.get(route('checkIfDisliked', { imdbID })).then((response) => {
    dislikeStatus.value = response.data.disliked;
  })
}

function dislikeMovie () {
  const data = {
    movie_id: props.movie.imdbID,
    title: props.movie.Title,
    dislike: dislikeStatus.value ? 0 : 1,
  }
  emit('dislike-movie', data)
  checkIfDisliked(props.movie.imdbID)
}

const commentStatus = ref(false);

onMounted(() => {
  checkIfLiked(props.movie.imdbID)
  checkIfDisliked(props.movie.imdbID)
})

</script>

<style scoped></style>