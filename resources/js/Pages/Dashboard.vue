<script lang="ts" setup>
import AppPageContent from "@/Components/AppPageContent.vue";
import DashboardWidget from "@/Components/DashboardWidget.vue";
import {MedicineResource} from "@/types/resource";
import MedicineIcon from "@/Components/Svg/MedicineIcon.vue";
import ReadingIcon from "@/Components/Svg/ReadingIcon.vue";
import LineChart, {ChartData} from "@/Components/LineChart.vue";

interface LowHighReading {
    date: string,
    reading: number,
}

defineProps<{
    medicines: Array<MedicineResource>,
    highestReading: LowHighReading,
    lowestReading: LowHighReading,
    chart: ChartData,
}>()
</script>

<template>
    <AppPageContent :title="$t('nav.dashboard')">
        <div class="flex gap-4 flex-col md:flex-row">
            <!-- Medicines -->
            <DashboardWidget class="bg-yellow-300/30 dark:bg-yellow-500/60">
                <template #header>
                    {{ $t('nav.medicine') }}
                </template>
                <template #icon>
                    <MedicineIcon class="w-10 h-10 fill-white"/>
                </template>
                <template #default>
                    <div v-for="medicine in medicines" :key="medicine.name" class="dark:text-slate-300 text-sm">
                        {{ medicine.name }}
                    </div>
                </template>
            </DashboardWidget>

            <!-- High + low readings -->
            <DashboardWidget class="bg-green-300/30 dark:bg-green-800/80">
                <template #header>
                    {{ $t('dashboard.widgets.high_low_readings.title') }}
                </template>
                <template #icon>
                    <ReadingIcon class="w-10 h-10 fill-white"/>
                </template>
                <template #default>
                    <div class="dark:text-slate-400 flex flex-col">
                        <span v-if="lowestReading.date" class="flex gap-1">
                            <span class="text-green-600 dark:text-green-500 font-bold">{{ $t('dashboard.widgets.high_low_readings.low') }}:</span>
                            <span class="text-green-600 dark:text-green-500 font-bold">{{ lowestReading.reading }}</span>
                            <span>at {{ lowestReading.date }}</span>
                        </span>
                        <span v-else>{{ $t('dashboard.no_data_found') }}</span>
                        <span v-if="highestReading.date" class="flex gap-1">
                            <span class="text-red-600 dark:text-red-400 font-bold">{{ $t('dashboard.widgets.high_low_readings.high') }}:</span>
                            <span class="text-red-600 dark:text-red-400 font-bold">{{ highestReading.reading }}</span>
                            <span>at {{ highestReading.date }}</span>
                        </span>
                        <span v-else>{{ $t('dashboard.no_data_found') }}</span>
                    </div>
                </template>
            </DashboardWidget>
        </div>

        <!-- Line graph -->
        <DashboardWidget class="w-full mt-4 bg-slate-100 dark:bg-gray-100/50">
            <template #header>
                <div class="text-gray-800">{{ $t('dashboard.widgets.graph') }}</div>
            </template>
            <div v-if="chart.labels.length">
                <LineChart :chart="chart" class="h-64"/>
            </div>
            <div v-else>
                <span class="text-2xl text-slate-500">{{ $t('dashboard.no_data_found') }}</span>
            </div>
        </DashboardWidget>
    </AppPageContent>
</template>
