<script setup>
import Image from "@/Components/Image.vue";

const props = defineProps(['modelValue', 'name'])
const emits = defineEmits(['update:modelValue'])

const changeFile = ($event) => {
    emits('update:modelValue', $event.target.files[0])
}

</script>

<template>
    <div>
        <Image
            v-if="typeof modelValue === 'string'"
            :image="modelValue"
            class="w-[75px] h-[75px] object-cover rounded-full mt-3"
        />
        <div>
            <input class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer  focus:outline-none mt-3"
                   id="file_input"
                   type="file"
                   :name="name"
                   @input="changeFile($event)"
            >
        </div>
    </div>
</template>

<style scoped>

</style>
