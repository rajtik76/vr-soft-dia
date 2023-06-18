<script lang="ts" setup>
import AppPageContent from "@/Components/AppPageContent.vue";
import {BloodSugarReading} from "@/types/resource";
import BloodSugarReadingForm from "@/Pages/BloodSugarReading/Partials/BloodSugarReadingForm.vue";

defineProps<{
    reading: BloodSugarReading
}>()
</script>

<template>
    <AppPageContent :title="$t('blood_sugar_reading.new')">
        <BloodSugarReadingForm :reading="reading"/>
    </AppPageContent>
</template>
