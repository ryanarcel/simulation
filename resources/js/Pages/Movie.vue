<template>
    <div class="bg-gray-100 mx-auto rounded shadow-2xl p-5 w-64 my-7">
        <h1 class="text-xl font-bold mb-2">{{ props.movie.Title }}</h1>
        <img :src="props.movie.Poster" alt="">
    </div>
</template>

<script setup>

import { ref, defineProps } from 'vue'

const props = defineProps({
    movie: Object
})

console.log(props.movie)

</script>

<style lang="scss" scoped>

</style>