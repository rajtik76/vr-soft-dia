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
        {name: 'name', label: t('base.name')},
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
            router.get(route('medicine.edit', {medicine: id}))
            break
        case GridButtonsActionEnum.Delete:
            if (confirm(t('base.confirm'))) {
                router.delete(route('medicine.destroy', {medicine: id}), {
                    // onSuccess: () => grid.value.updateGrid(),
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
    <AppPageContent :title="$t('nav.medicine')">
        <div class="text-center">
            <PrimaryButton @click="router.get(route('medicine.create'))">{{ $t('medicine.new') }}</PrimaryButton>
        </div>
        <div class="mt-8">
            <AppGrid :columns="medicineColumns()" :grid-url="route('grid.medicine')" ref="grid">
                <template #actions="{ row }: { row: MedicineResource }">
                    <AppGridActions :buttons="actionButtons()" @click="handleActionButtonClick($event, row.id)"/>
                </template>
            </AppGrid>
        </div>
    </AppPageContent>
</template>

<style scoped>

</style>
