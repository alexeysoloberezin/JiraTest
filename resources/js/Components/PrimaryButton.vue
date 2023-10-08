<template>
    <button
        class="inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs  uppercase tracking-widest  focus:outline-none  focus:ring-offset-2 transition ease-in-out duration-150"
        :class="variant"
    >
        <slot />
    </button>
</template>


<script setup>
import {computed} from "vue";

const props = defineProps(['outline'])


const variant = computed(() => {
    if(props?.outline){
        return 'text-gray-800 border-gray-800 hover:bg-gray-300 focus:bg-gray-700 active:bg-gray-900 focus:ring-2 focus:ring-indigo-500 '
    }else{
        return 'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-2 focus:ring-indigo-500'
    }
})
</script>
