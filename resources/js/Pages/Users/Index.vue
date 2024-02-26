<template lang="">
    <div>
        <h1>Hello {{name}}!</h1>
        <a :href="route('second')">Go to Route</a>
    </div>
</template>
<script>
export default {
    props: {
        name: String,
    }
    
}
</script>
<style lang="">
    
</style>