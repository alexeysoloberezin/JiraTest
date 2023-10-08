<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BackButton from "@/Components/Buttons/BackButton.vue";
import {Link} from '@inertiajs/vue3';
import TaskList from "@/Components/tasks/TaskList.vue";

const props = defineProps(['category', 'task_columns'])
</script>

<template>
    <AuthenticatedLayout>
        <section v-if="category" class="text-gray-600 body-font  container">
            <Link :href="route('dashboard')">
                <BackButton />
            </Link>
            <h1 class="text-3xl font-bold text-black my-2">{{ category.title }}</h1>
            <h3 class="text-md">{{ category.text }}</h3>


            <TaskList :category="category" :key="category"/>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
