<script lang="ts" setup>
import AppLogo from '@/Components/AppLogo.vue';
import {Link} from '@inertiajs/vue3';
import ThemeSwitch from "@/Components/ThemeSwitch.vue";
import LocaleSwitch from "@/Components/LocaleSwitch.vue";
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">
        <div class="flex justify-end px-12 pt-4">
            <ThemeSwitch/>
            <LocaleSwitch/>
        </div>

        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 grow">
            <div>
                <Link href="/">
                    <AppLogo class="w-20 h-20 fill-current text-gray-500"/>
                </Link>
            </div>

            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
            >
                <slot/>
            </div>
        </div>
    </div>
</template>
