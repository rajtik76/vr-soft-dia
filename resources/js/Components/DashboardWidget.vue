<script lang="ts" setup>

</script>

<template>
    <div class="rounded-lg border border-gray-300 dark:border-gray-500 px-8 py-4 w-fit h-1/12 flex flex-col justify-between">
        <div class="capitalize font-bold text-xl flex gap-20 items-center justify-between">
            <slot name="header"/>
            <div v-if="$slots['icon']" class="rounded-full p-6 bg-slate-800/75 shadow-lg">
                <slot name="icon"/>
            </div>
        </div>
        <div class="mt-4">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

</style>
