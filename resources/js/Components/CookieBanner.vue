<script setup lang="ts">

import PrimaryButton from "@/Components/PrimaryButton.vue";
import {onMounted, ref} from "vue";

const displayBanner = ref<boolean>(true)

onMounted(() => {
    console.log(localStorage.cookie_banner_display)
    displayBanner.value = !Object(localStorage).hasOwnProperty('cookie_banner_display')
})

function hideBanner() {
    localStorage.cookie_banner_display = false
    displayBanner.value = false
}
</script>

<template>
    <div v-if="displayBanner" class="fixed bottom-0 pt-4 px-4 bg-gray-300/90 dark:bg-slate-100/90 border-t border-gray-400 w-full flex flex-col justify-center items-center">
        <p class="text-center">{{ $t('cookie_banner') }}</p>
        <PrimaryButton class="w-fit my-4 !bg-sky-600 hover:!bg-sky-400 dark:!bg-sky-300 dark:hover:!bg-sky-500" @click="hideBanner">
            {{ $t('base.close') }}
        </PrimaryButton>
    </div>
</template>
