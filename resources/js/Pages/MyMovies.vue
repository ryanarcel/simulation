<template>

  <Head title="My Movies" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Liked Movies
      </h2>
    </template>

    <div class="lg:w-3/5 md:2/5 mx-auto mt-5">
      <div class="overflow-x-auto">
        <h1 class="font-bold">Liked Movies</h1>
        <table class="table-auto w-full border-collapse">
          <thead>
            <tr>
              <th class="px-4 py-2 bg-gray-100 text-gray-700">
                Title
              </th>
              <th class="px-4 py-2 bg-gray-100 text-gray-700">
                Year
              </th>
              <th class="px-4 py-2 bg-gray-100 text-gray-700">
                Remove
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="movie in likedMovies" class="border">
              <td class="px-4 py-2 text-center w-3/5">
                {{ movie.title }}
              </td>
              <td class="px-4 py-2 text-center w-1/5">
                {{ movie.year }}
              </td>
              <td class="px-4 py-2 text-center w-1/5">
                <i :class="[
              'fas',
              'fa-xmark text-validationRed cursor-pointer hover:text-red-800',
            ]" @click="likeMovie(movie)"></i>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h1 class="font-bold mt-4">Disliked Movies</h1>
      <table class="table-auto w-full border-collapse">
        <thead>
          <tr class="border">
            <th class="px-4 py-2 bg-gray-100 text-gray-700">
              Title
            </th>
            <th class="px-4 py-2 bg-gray-100 text-gray-700">
              Year
            </th>
            <th class="px-4 py-2 bg-gray-100 text-gray-700">
              Remove
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="movie in dislikedMovies" class="border">
            <td class="px-4 py-2 text-center w-3/5">
              {{ movie.title }}
            </td>
            <td class="px-4 py-2 text-center w-1/5">
              {{ movie.year }}
            </td>
            <td class="px-4 py-2 text-center w-1/5">
              <i :class="[
              'fas',
              'fa-xmark text-validationRed cursor-pointer hover:text-red-800',
            ]" @click="dislikeMovie(movie)"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, defineProps, onMounted, watch } from "vue";
import { useToast } from "vue-toastification";
import { usePage } from '@inertiajs/vue3';

const toast = useToast();
const { $inertia } = usePage();

const props = defineProps({
  likedMovies: Array,
  dislikedMovies: Array,
});

watch(
  () => [props.likedMovies, props.dislikedMovies],
  () => {
    resetMovies();
    refreshValues.value = !refreshValues.value;
  }
);

let renderedLikedMovies = ref(null);
let renderedDislikeMovies = ref(null);
let refreshValues = ref(false);

function resetMovies() {
  renderedLikedMovies = props ? props.likedMovies : null;
  renderedDislikeMovies = props ? props.dislikedMovies : null;
}

async function likeMovie(movie) {
  const data = {
    movie_id: movie.imdbID,
    title: movie.title,
    year: movie.year,
  };

  router.visit(route('myMovies'));

  await axios.post(route("likeMovie"), data).then((response) => {

    toast.info(`Dislike for ${data.title} removed`, {
      position: "bottom-center",
      timeout: 2000,
      closeOnClick: true,
      pauseOnHover: false,
      draggable: true,
      draggablePercent: 0.6,
      showCloseButtonOnHover: false,
      hideProgressBar: true,
      closeButton: "button",
      icon: true,
    });
    
  });
}

async function dislikeMovie(movie) {
  const data = {
    movie_id: movie.imdbID,
    title: movie.title,
    year: movie.year,
  };

  await axios.post(route("dislikeMovie"), data).then((response) => {

    toast.info(`Dislike for ${data.title} removed`, {
      position: "bottom-center",
      timeout: 2000,
      closeOnClick: true,
      pauseOnHover: false,
      draggable: true,
      draggablePercent: 0.6,
      showCloseButtonOnHover: false,
      hideProgressBar: true,
      closeButton: "button",
      icon: true,
    });
    
  });
}

onMounted(() => {
  resetMovies();
});
</script>
