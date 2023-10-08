<script setup>
defineProps(['image'])
</script>

<template>
    <img
        :src="'storage/' + image" alt=""
    >
</template>

<style scoped>

</style>
