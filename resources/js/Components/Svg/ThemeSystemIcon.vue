<script setup lang="ts">
withDefaults(defineProps<{ highlighted?: boolean }>(), {
  highlighted: false
})
</script>

<template>
  <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6 mr-2">
    <path d="M4 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6Z" stroke-width="2"
          stroke-linejoin="round"
          :class="{'stroke-slate-400 dark:stroke-slate-500': !highlighted, 'stroke-sky-500 fill-sky-400/20': highlighted}"/>
    <path d="M14 15c0 3 2 5 2 5H8s2-2 2-5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          :class="{'stroke-slate-400 dark:stroke-slate-500': !highlighted, 'stroke-sky-500': highlighted}"/>
  </svg>
</template>