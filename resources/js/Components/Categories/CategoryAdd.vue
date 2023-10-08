<script setup>
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps([''])
const emit = defineEmits(['addCategory'])

const form = useForm({
    title: '',
    text: ''
})

const showForm = ref(false)

const onFormSubmit = () => {
    emit('addCategory', form.data())
}

</script>

<template>
    <div class="border border-gray-200 p-6 rounded-lg flex flex-col justify-center">
        <template v-if="!showForm">
            <h2 class="text-2xl text-gray-800 font-medium title-font mb-2 text-center">Add new category</h2>
            <button
                @click.stop.prevent="showForm = true"
                class="flex mx-auto text-white mt-3 bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                Create
            </button>
        </template>

        <form v-else @submit.prevent="onFormSubmit" class=" space-y-2">
            <div>
                <InputLabel for="title" value="Title"/>

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    :height="'h-[32px]'"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.title"/>
            </div>
            <div>
                <InputLabel for="text" value="Text"/>

                <TextInput
                    id="text"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.text"
                    required
                    :height="'h-[32px]'"
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.title"/>
            </div>
            <PrimaryButton :disabled="form.processing" class="mr-2">Save</PrimaryButton>
            <PrimaryButton @click="form.reset();showForm = false" :outline="true">Close</PrimaryButton>
        </form>
    </div>
</template>

<style scoped>

</style>
