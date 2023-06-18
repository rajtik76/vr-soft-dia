<script lang="ts" setup>

import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppGrid from "@/Components/AppGrid.vue";
import {GridColumn} from "@/types/grid";
import {useI18n} from "vue-i18n";
import AppPageContent from "@/Components/AppPageContent.vue";
import {MedicineResource} from "@/types/resource";
import AppGridActions, {GridActionButton} from "@/Components/AppGridActions.vue";
import {ref} from "vue";

enum GridButtonsActionEnum {
    Edit = 'edit',
    Delete = 'delete'
}

const {t} = useI18n()
const grid = ref<InstanceType<typeof AppGrid>>()

function medicineColumns(): Array<GridColumn> {
    return [
        {name: 'date', label: t('blood_sugar_reading.date'), sortable: true, default: {sort: "desc"}},
        {name: 'before_breakfast', label: t('blood_sugar_reading.before_breakfast')},
        {name: 'after_breakfast', label: t('blood_sugar_reading.after_breakfast')},
        {name: 'before_lunch', label: t('blood_sugar_reading.before_lunch')},
        {name: 'after_lunch', label: t('blood_sugar_reading.after_lunch')},
        {name: 'before_dinner', label: t('blood_sugar_reading.before_dinner')},
        {name: 'after_dinner', label: t('blood_sugar_reading.after_dinner')},
        {name: 'actions', label: t('base.actions')},
    ]
}

function actionButtons(): Array<GridActionButton> {
    return [
        {name: GridButtonsActionEnum.Edit, label: t('base.edit'), class: 'hover:!bg-blue-300'},
        {name: GridButtonsActionEnum.Delete, label: t('base.delete'), class: 'hover:!bg-red-300'},
    ]
}

function handleActionButtonClick(action: GridButtonsActionEnum, id: number): void {
    switch (action) {
        case GridButtonsActionEnum.Edit:
            router.get(route('bloodSugarReading.edit', {bloodSugarReading: id}))
            break
        case GridButtonsActionEnum.Delete:
            if (confirm(t('base.confirm'))) {
                router.delete(route('bloodSugarReading.destroy', {bloodSugarReading: id}), {
                    onSuccess: () => grid.value?.updateGrid(),
                    preserveScroll: true
                })
            }
            break
        default:
            console.error(`Unknown action: ${action}`)
    }
}
</script>

<template>
    <AppPageContent :title="$t('nav.blood_sugar_reading')">
        <div class="text-center">
            <PrimaryButton @click="router.get(route('bloodSugarReading.create'))">{{
                    $t('blood_sugar_reading.new')
                }}
            </PrimaryButton>
        </div>
        <div class="mt-8">
            <AppGrid ref="grid" :columns="medicineColumns()" :grid-url="route('grid.bloodSugarReadings')">
                <template #actions="{ row }: { row: MedicineResource }">
                    <AppGridActions :buttons="actionButtons()" @click="handleActionButtonClick($event, row.id)"/>
                </template>
            </AppGrid>
        </div>
    </AppPageContent>
</template>

<style scoped>

</style>
