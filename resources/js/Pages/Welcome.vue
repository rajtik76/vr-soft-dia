<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import diaLogo from '../../img/dia-logo-128.png'
import LightDarkModeSwitch from "@/Components/LightDarkModeSwitch.vue";
import LangSwitch from "@/Components/LangSwitch.vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();
</script>

<template>
    <Head title="Welcome"/>

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div class="flex items-center gap-4 sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <div v-if="canLogin">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >
                    {{ $t('nav.dashboard') }}
                </Link>

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >
                        {{ $t('nav.login') }}
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >
                        {{ $t('nav.register') }}
                    </Link>
                </template>
            </div>
            <LangSwitch/>
            <LightDarkModeSwitch/>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <img :src="diaLogo" class="pulse"/>
            </div>

            <div class="text-gray-500 dark:text-gray-400">
                <h3 class="mt-8 py-4 text-2xl lg:text-5xl text-center font-extrabold text-transparent bg-clip-text bg-gradient-to-br dark:from-red-400 dark:to-gray-200 from-red-500 to-violet-500">
                    {{ $t('facts.0') }}
                </h3>

                <div class="mt-12 text-base lg:text-lg">
                    <div v-for="index in [1,2,3,4,5,6,7,8,9,10]" :key="`fact-${index}`" class="fact-item">
                        <span class="fact-number">{{ index }}.</span> {{ $t(`facts.${index}`) }}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-center mt-16 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                    <div class="flex items-center gap-4">
                        <a
                            href="https://vr-soft.eu"
                            class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                class="-mt-px mr-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
                                />
                            </svg>
                            VR Soft
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.fact-number {
    @apply text-red-500 dark:text-red-300
}

.fact-item {
    @apply py-2.5 border-b border-gray-200 dark:border-gray-800 hover:bg-slate-200 dark:hover:bg-slate-700 dark:text-gray-500 dark:hover:text-gray-300 rounded-lg px-2
}

.pulse {
    animation-name: pulseAnimation;
    animation-duration: 2.5s;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
}

@keyframes pulseAnimation {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
    }
}
</style>
