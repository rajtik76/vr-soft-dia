<script lang="ts" setup>

import {onMounted, ref, watch} from "vue";
import ThemeLightIcon from "@/Components/Svg/ThemeLightIcon.vue";
import ThemeDarkIcon from "@/Components/Svg/ThemeDarkIcon.vue";
import ThemeSystemIcon from "@/Components/Svg/ThemeSystemIcon.vue";

enum ThemeEnum {
    Light = 'light',
    Dark = 'dark',
    System = 'system',
}

const menuButton = ref()
const theme = ref<string>(ThemeEnum.Light)
const displayMenu = ref<boolean>(false)

// watch for display menu
watch(displayMenu, (displayed) => {
    if (displayed) {
        window.addEventListener('click', clickOutside)
    } else {
        window.removeEventListener('click', clickOutside)
    }
})

// watch theme change
watch(theme, (value) => {
    switch (value) {
        case ThemeEnum.Light:
            localStorage.theme = ThemeEnum.Light
            break
        case ThemeEnum.Dark:
            localStorage.theme = ThemeEnum.Dark
            break
        case ThemeEnum.System:
            localStorage.removeItem('theme')
            break
    }

    applyModeChange()
    displayMenu.value = false
})

function applyModeChange(): void {
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }

    if (localStorage.theme === ThemeEnum.Light) {
        theme.value = ThemeEnum.Light
    } else if (localStorage.theme === ThemeEnum.Dark) {
        theme.value = ThemeEnum.Dark
    } else if (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        theme.value = ThemeEnum.System
    }
}

function clickOutside(event) {
    if (!event.composedPath().includes(menuButton.value)) {
        displayMenu.value = false
    }
}

onMounted(() => applyModeChange())
</script>

<template>
    <div class="dark:bg-gray-900">
        <div class="flex items-center gap-1 w-fit hover:cursor-pointer"
             ref="menuButton"
             @click="displayMenu = !displayMenu">
            <ThemeLightIcon v-if="theme === ThemeEnum.Light" :highlighted="true"/>
            <ThemeDarkIcon v-if="theme === ThemeEnum.Dark" :highlighted="true"/>
            <ThemeDarkIcon v-if="theme === ThemeEnum.System"/>
        </div>

        <ul v-show="displayMenu"
            class="absolute z-50 top-16 left-auto bg-white rounded-lg ring-1 ring-slate-900/10 shadow-lg overflow-hidden w-36 py-1 text-sm text-slate-700 font-semibold dark:bg-slate-800 dark:ring-0 dark:highlight-white/5 dark:text-slate-300">
            <!-- Light mode -->
            <li :class="{'text-sky-500': theme === ThemeEnum.Light}" class="py-1 px-2 flex items-center cursor-pointer"
                @click="theme = ThemeEnum.Light">
                <ThemeLightIcon :highlighted="theme === ThemeEnum.Light"/>
                {{ $t('nav.theme.light') }}
            </li>
            <!-- Dark mode -->
            <li :class="{'text-sky-500': theme === ThemeEnum.Dark}" class="py-1 px-2 flex items-center cursor-pointer"
                @click="theme = ThemeEnum.Dark">
                <ThemeDarkIcon :highlighted="theme === ThemeEnum.Dark"/>
                {{ $t('nav.theme.dark') }}
            </li>
            <!-- System settings -->
            <li :class="{'text-sky-500': theme === ThemeEnum.System}" class="py-1 px-2 flex items-center cursor-pointer"
                @click="theme = ThemeEnum.System">
                <ThemeSystemIcon :highlighted="theme === ThemeEnum.System"/>
                {{ $t('nav.theme.system') }}
            </li>
        </ul>
    </div>
</template>
