<script lang="ts" setup>
import BaseSelect from "@/Components/BaseSelect.vue";
import {usePage} from "@inertiajs/vue3";
import {useI18n} from "vue-i18n";
import axios from "axios";
import {onMounted} from "vue";

const {locale} = useI18n({useScope: "global"})
const page = usePage()

// Primary use localstorage as only source of the truth. When I used PHP session then it was reset to the default value on logout because session was destroyed
function changeLocale(value: string): void {
    localStorage.locale = value
    locale.value = value

    axios.post(route('locale-switch', {locale: value}))
}

onMounted(() => locale.value = localStorage.locale ?? page.props.locale)
</script>

<template>
    <BaseSelect
        v-model="locale"
        :options="Object.fromEntries(Object.entries($i18n.availableLocales).map(([, l]) => [l, l]))"
        class="font-semibold text-gray-600 hover:text-gray-900 bg-gray-200 dark:text-gray-400 dark:bg-slate-700 focus:ring-2 rounded-full border-0 py-0.5 w-fit text-sm"
        @change="changeLocale($event.target.value)"
    />
</template>
