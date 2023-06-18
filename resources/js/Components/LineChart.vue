<script lang="ts" setup>
import {CategoryScale, Chart as ChartJS, Legend, LinearScale, LineElement, PointElement, Title, Tooltip} from 'chart.js'
import {Line} from 'vue-chartjs'
import {computed, reactive, ref} from "vue";
import {useI18n} from "vue-i18n";

export interface ChartData {
    labels: Array<string>,
    beforeBreakfast: Array<number>,
    afterBreakfast: Array<number>,
    beforeLunch: Array<number>,
    afterLunch: Array<number>,
    beforeDinner: Array<number>,
    afterDinner: Array<number>,
}

const props = defineProps<{
    chart: ChartData,
}>()

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
)

const options = ref({
    responsive: true,
    maintainAspectRatio: false,
})

const {t} = useI18n()

const data = computed(() => {
    return {
        labels: props.chart.labels,
        datasets: [
            {
                label: t('blood_sugar_reading.before_breakfast'),
                borderColor: '#ea904a',
                backgroundColor: '#ea904a',
                data: props.chart.beforeBreakfast
            },
            {
                label: t('blood_sugar_reading.after_breakfast'),
                borderColor: '#a45616',
                backgroundColor: '#a45616',
                data: props.chart.afterBreakfast
            },
            {
                label: t('blood_sugar_reading.before_lunch'),
                borderColor: '#e5a92b',
                backgroundColor: '#e5a92b',
                data: props.chart.beforeLunch
            },
            {
                label: t('blood_sugar_reading.after_lunch'),
                borderColor: '#ead240',
                backgroundColor: '#ead240',
                data: props.chart.afterLunch
            },
            {
                label: t('blood_sugar_reading.before_dinner'),
                borderColor: '#9cd920',
                backgroundColor: '#9cd920',
                data: props.chart.beforeDinner
            },
            {
                label: t('blood_sugar_reading.after_dinner'),
                borderColor: '#74dcb3',
                backgroundColor: '#74dcb3',
                data: props.chart.afterDinner
            }
        ]
    }
})
</script>

<template>
    <Line :data="data" :options="options" :default="{color: '#FFF'}"/>
</template>

<style scoped>

</style>
