<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AppPageContent from "@/Components/AppPageContent.vue";
</script>

<template>
    <AppPageContent :title="$t('nav.dashboard')">
        Tady bude dashboard
    </AppPageContent>
</template>
