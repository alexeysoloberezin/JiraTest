<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps(['btns'])
const emits = defineEmits(['clickOnBtns'])

const stylesRounded = (index) => {
    switch (index) {
        case 0:
            return 'rounded-l-lg'
        case props?.btns.length - 1 :
            return 'rounded-r-lg'
        default:
            return 'rounded-lg'
    }
}

const linkType = (link) => {
    return link ? Link : 'div';
}

</script>

<template>
    <div class="inline-flex rounded-md shadow-sm" role="group">
        <button v-for="(btn, index) in btns"
                :key="btn.text"
                type="button"
                @click.stop.prevent="!btn.link ? btn.cb() : null"
                :class="`${stylesRounded(index)}`"
                class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            <component :is="linkType(btn?.link)" :href="btn?.link" >
                {{ btn.text }}
            </component>
        </button>
    </div>
</template>

<style scoped>

</style>
