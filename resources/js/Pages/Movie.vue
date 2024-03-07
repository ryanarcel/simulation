<template>
  <div class="block border mx-auto rounded shadow-2xl p-5 w-64 my-7 hover:bg-gray-300">
    <h1 class="text-xl font-bold mb-2 h-16 flex items-center justify-center text-center">{{ props.movie.Title }}</h1>
    <img :src="props.movie.Poster" alt="" class="mt-5">
    <div class="flex justify-center">
      <i :class="[likeStatus ? 'fas' : 'far', 'mx-2 fa-thumbs-up text-2xl text-greenBlue mt-5 cursor-pointer hover:text-yellow']"
        @click="likeMovie()"></i>
      <i :class="[dislikeStatus ? 'fas' : 'far', 'mx-2 fa-thumbs-down text-2xl text-validationRed mt-5 cursor-pointer hover:text-yellow']"
        @click="showFormAlert"></i>
      <i :class="[commentStatus ? 'fas' : 'far', 'mx-2 fa-comment text-2xl text-pumpkin mt-5 cursor-pointer hover:text-yellow']"
        @click="showFormAlert"></i>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'
import { useToast } from "vue-toastification";

const props = defineProps({
  movie: Object,
  // likedStatus: Boolean,
})

const toast = useToast();

const likeStatus= ref(false);
const dislikeStatus= ref(false);
const commentStatus= ref(false);

// onMounted(() => {
//   fetchLikedStatus();
// });



function likeMovie () {
  const data = {
    movie_id: props.movie.imdbID,
    title: props.movie.Title,
    like: likeStatus.value ? 0 : 1,
  }
  router.post(route('likeMovie'), data, { preserveScroll: true })

  toast.success(`${props.movie.Title} liked!`, {
    position: "bottom-center",
    timeout: 2000,
    closeOnClick: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
  });
}

</script>

<style scoped></style>