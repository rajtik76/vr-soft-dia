<script lang="ts" setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";

export interface GridActionButton {
    name: string,
    label: string,
    class?: string | undefined
}

defineProps<{
    buttons: Array<GridActionButton>
}>()

const emit = defineEmits(['click'])
</script>

<template>
    <div class="flex gap-1">
        <PrimaryButton
            v-for="(button, index) in buttons"
            :key="index"
            :class="button?.class"
            @click="emit('click', button.name)"
        >
            {{ button.label }}
        </PrimaryButton>
    </div>
</template>
