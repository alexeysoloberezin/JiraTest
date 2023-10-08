<script setup>
import {computed, onMounted, ref} from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    height: {
        type: String,
        default: 'h-[42px]'
    },
    placeholder: {
        type: String,
        default: ''
    },
    error: {
        type: Boolean,
        default: false
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

const isError = computed(() => {
    if(props?.error) {
        return 'border-red-300';
    }

    return 'border-gray-300'
})

</script>

<template>
    <input
        class=" focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :class="`${height}  ${isError}`"
        :value="modelValue"
        :placeholder="placeholder"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
