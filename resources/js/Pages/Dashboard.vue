<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-200 leading-tight ">Dashboard</h2>
    </template>

    <form @submit.prevent="submit" class="mt-10 flex flex-col items-center">
      <div class="mx-auto block w-3/5">
        <div class="mt-2">
          <input v-model="form.search" type="text" name="search" id="search"
            placeholder="Search your movie"
            class="block w-3/5 mx-auto rounded-md border-0 py-5 text-gray-900 shadow-sm ring-1 ring-inset lg:text-lg ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        </div>
      </div>
      <button class="bg-pumpkin text-gray-700 lg:text-lg font-black py-2 px-4 rounded mt-5" type="submit">
        Search Movie
      </button>
    </form>

    <div class="w-3/5 mx-auto">
      <div v-if="searchResults" class="grid lg:grid-cols-4 mt-10">
        <Movie v-for="movie in searchResults" :movie="movie"/>
      </div>
    </div>

  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Movie from './Movie.vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps(['response']);

const form = reactive({
  search: null,
});

const searchResults = reactive(props.response.Search); // Use reactive instead of ref

// Watch for changes in props.response and update searchResults accordingly
watch(() => props.response.Search, (newSearchResults) => {
  searchResults = newSearchResults;
});

function submit() {
  // Perform the search and update the page using Inertia.js
  router.visit(route('dashboard', { search: form.search }));
}

</script>