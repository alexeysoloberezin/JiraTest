<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import {ref} from "vue";
import CategoryAdd from "@/Components/Categories/CategoryAdd.vue";
import {Link} from '@inertiajs/vue3';
import DeleteButton from "@/Components/Buttons/DeleteButton.vue";


const props = defineProps(['categories'])

const task = ref([])

const deleteCategory = (id) => {
    router.delete('/categories/' + id)
}

const addCategory = ({title, text}) => {
    console.log('123')
    router.post('/categories', {title, text})
}

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-10 mx-auto">
                <div class="flex flex-wrap w-full mb-10 flex-col items-center text-center">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Here you can find your
                        categories</h1>
                    <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">

                    </p>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <Link
                        v-for="category in categories"
                        :href="route('categories.show', {id: category.id})"
                    >
                        <div
                            :key="category.id"
                            class="border border-gray-200 p-6 rounded-lg cursor-pointer hover:bg-gray-200 transition relative"
                        >
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                     stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">{{ category.title }}</h2>
                            <p class="leading-relaxed text-base textSlice">{{ category.text }}</p>

                            <DeleteButton
                                @click.prevent.stop="deleteCategory(category.id)"
                                class="absolute top-2 right-0"
                            />
                        </div>
                    </Link>


                    <CategoryAdd
                        @addCategory="addCategory"
                    />
                </div>


            </div>
        </section>
    </AuthenticatedLayout>
</template>
