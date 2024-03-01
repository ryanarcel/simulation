<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <form @submit.prevent="submit" class="mt-10 flex flex-col items-center">
      <div class="mx-auto block w-3/5">
        <div class="mt-2">
          <input v-model="form.search" type="text" name="search" id="search" autocomplete="search"
            placeholder="Search your movie"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        </div>
      </div>
      <button class="bg-gray-100 text-greenBlue font-bold py-2 px-4 rounded mt-5" type="submit">
        Search Movie
      </button>
    </form>

    <ul v-if="searchResults">
      <li v-for="movie in searchResults">
        {{ movie.Title }}
      </li>
    </ul>

  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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