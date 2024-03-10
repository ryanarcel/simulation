<template>
  <Head title="My Movies" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Liked Movies
      </h2>
    </template>

    <div class="lg:w-4/5 mx-auto mt-5">
      <div class="overflow-x-auto">
        <h1 class="font-bold">Liked Movies</h1>
        <table class="table-auto w-full border-collapse">
          <thead>
            <tr>
              <th class="px-4 py-2 bg-gray-100 text-gray-700">Title</th>
              <th class="px-4 py-2 bg-gray-100 text-gray-700">Year</th>
              <th class="px-4 py-2 bg-gray-100 text-gray-700">Options</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="movie in likedMovies" class="border">
              <td class="px-4 py-2">{{ movie.Title }}</td>
              <td class="px-4 py-2">Options</td>
            </tr>
          </tbody>
        </table>
      </div>


      <h1 class="font-bold mt-4">Disliked Movies</h1>
      <table class="table-auto w-full border-collapse">
        <thead>
          <tr class="border">
            <th class="px-4 py-2 bg-gray-100 text-gray-700">Title</th>
            <th class="px-4 py-2 bg-gray-100 text-gray-700">Year</th>
            <th class="px-4 py-2 bg-gray-100 text-gray-700">Options</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="movie in dislikedMovies" class="border">
            <td class="px-4 py-2">{{ movie.Title }}</td>
            <td class="px-4 py-2">Options</td>
          </tr>
        </tbody>
      </table>
    </div>


  </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
  likedMovies: Array,
  dislikedMovies: Array,
});

</script>
