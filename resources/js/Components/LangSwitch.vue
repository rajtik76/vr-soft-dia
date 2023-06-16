<script setup lang="ts">
import BaseSelect from "@/Components/BaseSelect.vue";
import {onMounted, ref, watch} from "vue";
import {useI18n} from "vue-i18n";

const {locale} = useI18n({useScope: 'global'})
const lang = ref(localStorage.lang ?? locale.value)

watch(lang, (value) => {
    localStorage.lang = value
    changeLang()
})

function changeLang() {
    locale.value = lang.value
}

onMounted(() => changeLang())
</script>

<template>
    <BaseSelect
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:bg-slate-700 focus:ring-2 rounded-full border-0 py-0.5 w-fit text-sm"
        :options="Object.fromEntries(Object.entries($i18n.availableLocales).map(([, l]) => [l, l]))"
                v-model="lang"/>
</template>
