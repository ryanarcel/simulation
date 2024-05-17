<template>
  <Head title="Reviews" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Dashboard
      </h2>
    </template>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, computed, watchEffect, defineProps } from 'vue';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
  comments: Array,

});


</script>

<style>
/* Your style code here */
</style>
