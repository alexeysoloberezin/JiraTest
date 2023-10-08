<script setup>
import {usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Avatar from "@/Components/Users/Avatar.vue";

console.log(usePage())
const { user } = usePage().props;

</script>

<template>
    <AuthenticatedLayout>
        <section v-if="user" class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto flex flex-col">
                <div class="lg:w-4/6 mx-auto">
                    <div  class="flex flex-col sm:flex-row mt-10">
                        <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
                            <Avatar
                                :user="user"
                                :size="'large'"
                            />
                            <div class="flex flex-col items-center text-center justify-center">
                                <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">{{ user.name }}</h2>
                                <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
<!--                                <p class="text-base"></p>-->
                            </div>
                        </div>
                        <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                            <h4 class="text-3xl font-bold text-black mb-3">About me</h4>
                            <p v-if="user.content" class="leading-relaxed text-lg mb-4">{{ user.content }}</p>
                            <p v-else class="leading-relaxed text-lg mb-4">No information about me</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div v-else>
            <h2 class="text-3xl text-center">User not found.</h2>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
