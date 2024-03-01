<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="grid  mt-10">
      <div class=" mx-auto block w-3/5">
        <label for="search" class="block text-lg font-medium leading-6 text-gray-100">Search</label>
        <div class="mt-2">
          <input type="text" name="search" id="search" autocomplete="search" placeholder="Search your movie"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        </div>
      </div>
    </div>

  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['response'])

console.log(props.response.Search)

</script>