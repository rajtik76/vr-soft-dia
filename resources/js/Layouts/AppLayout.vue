<script lang="ts" setup>

import CookieBanner from "@/Components/CookieBanner.vue";
</script>

<template>
    <div>
        <slot/>
    </div>

    <div>
        <CookieBanner/>
    </div>
</template>
