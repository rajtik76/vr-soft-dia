<script setup lang="ts">
import AppPageContent from "@/Components/AppPageContent.vue";
import MedicineForm from "@/Pages/Medicine/Partials/MedicineForm.vue";
import {MedicineResource} from "@/types/resource";

defineProps<{
    medicine: MedicineResource
}>()
</script>

<template>
    <AppPageContent :title="$t('medicine.new')">
        <MedicineForm :medicine="medicine"/>
    </AppPageContent>
</template>
