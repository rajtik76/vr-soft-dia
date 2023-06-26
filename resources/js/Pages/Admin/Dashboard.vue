<script lang="ts" setup>
import AppPageContent from "@/Components/AppPageContent.vue";
import {ChartData} from "@/Components/LineChart.vue";
import AppGrid from "@/Components/AppGrid.vue";
import {GridColumn} from "@/types/grid";
import {useI18n} from "vue-i18n";

const {t} = useI18n()

function getGridColumns(): Array<GridColumn> {
    return [
        {name: 'id', label: t('base.id'), sortable: true, default: {sort: "desc"}},
        {name: 'name', label: t('base.name')},
        {name: 'email', label: t('base.email')},
        {name: 'created_at', label: t('base.created'), sortable: true}
    ]
}
</script>

<template>
    <AppPageContent :title="$t('nav.admin')">
        <AppGrid :columns="getGridColumns()" :grid-url="route('grid.admin.users')"/>
    </AppPageContent>
</template>
