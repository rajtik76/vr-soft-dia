<script setup lang="ts">
defineProps<{
    modelValue: any,
    options: Record<number | string, string>,
}>()

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <select
        @change="emit('update:modelValue', ($event.target as HTMLInputElement).value)"
        :value="modelValue"
    >
        <option v-for="(value, key) in options" :key="`select-option-${key}`" :value="key">
            {{ value }}
        </option>
    </select>
</template>
