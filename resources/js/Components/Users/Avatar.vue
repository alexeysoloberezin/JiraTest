<script setup>
import {computed} from "vue";
import Image from "@/Components/Image.vue";

const props = defineProps(['user', 'size'])

const userAva = computed(() => {
    const {user} = props
    if (!user) return null

    if (user.img) {
        return {
            type: 'img',
            img: user.img
        }
    }

    return {
        type: 'text',
        name: user.name ? user.name.slice(0, 2) : user.email.slice(0, 2)
    }
})

const sizeComputed = computed(() => {
    switch (props.size) {
        case 'x-large':
            return {
                width: 'w-[100px] h-[100px]',
                text: 'text-4xl'
            }
        case 'large':
            return {
                width: 'w-[75px] h-[75px]',
                text: 'text-2xl'
            }
        case 'small':
            return {
                width: 'w-[35px] h-[35px]',
                text: 'text-sm'
            }
        default:
            return {
                width: 'w-[50px] h-[50px]',
                text: 'text-base'
            }
    }
})
</script>

<template>
    <template v-if="userAva">
        <Image
            v-if="userAva.type === 'img'"
            class="bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4"
            :image="userAva.img"
            :class="sizeComputed.width"
        />

        <div v-else
             :class="sizeComputed.width"
             class="relative inline-flex items-center justify-center overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600"
        >
            <span class="font-medium text-gray-600 dark:text-gray-300"
                  :class="sizeComputed.text"
            >
                {{ userAva.name }}
            </span>
        </div>
    </template>

</template>

<style scoped>

</style>
