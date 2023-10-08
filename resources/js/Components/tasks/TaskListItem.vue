<script setup>
defineProps(['task'])
</script>

<template>
    <div class="block cursor-grab max-w-sm p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100 ">
        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ task.title }}</h5>
        <p class="font-normal text-gray-700 text-sm">{{ task.text }}</p>
    </div>
</template>

<style scoped>

</style>
