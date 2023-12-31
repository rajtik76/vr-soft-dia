<script lang="ts" setup>
import {ref} from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link} from '@inertiajs/vue3';
import LocaleSwitch from "@/Components/LocaleSwitch.vue";
import ThemeSwitch from "@/Components/ThemeSwitch.vue";
import AppLogo from "@/Components/AppLogo.vue";
import AppAlert from "@/Components/AppAlert.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <AppLayout>
        <div>
            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
                <AppAlert v-if="$page.props.alerts.success" :message="$page.props.alerts.success" class="py-4"/>
                <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center">
                                    <Link :href="route('dashboard')">
                                        <AppLogo class="w-16 h-16"/>
                                    </Link>
                                </div>

                                <!-- Navigation Links -->
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <NavLink :active="route().current('dashboard')" :href="route('dashboard')">
                                        {{ $t('nav.dashboard') }}
                                    </NavLink>
                                    <NavLink :active="$page.component.startsWith('Medicine/')"
                                             :href="route('medicine.index')">
                                        {{ $t('nav.medicine') }}
                                    </NavLink>
                                    <NavLink :active="$page.component.startsWith('BloodSugarReading/')"
                                             :href="route('bloodSugarReading.index')">
                                        {{ $t('nav.blood_sugar_reading') }}
                                    </NavLink>
                                    <NavLink v-if="$page.props.auth.user.admin" :active="$page.component.startsWith('Admin/')"
                                             :href="route('admin.dashboard')">
                                        {{ $t('nav.admin') }}
                                    </NavLink>
                                </div>
                            </div>

                            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-2">
                                <ThemeSwitch class="dark:!bg-slate-800"/>
                                <LocaleSwitch/>
                                <!-- Settings Dropdown -->
                                <div>
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                                type="button"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        clip-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        fill-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> {{
                                                    $t('nav.profile')
                                                }}
                                            </DropdownLink>
                                            <DropdownLink :href="route('logout')" as="button" method="post">
                                                {{ $t('nav.logout') }}
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <div class="-mr-2 flex items-center sm:hidden">
                                <button
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                                >
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                            d="M4 6h16M4 12h16M4 18h16"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                        />
                                        <path
                                            :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                            d="M6 18L18 6M6 6l12 12"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div
                        :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                        class="sm:hidden"
                    >
                        <div class="pt-2 pb-3 space-y-1">
                            <ResponsiveNavLink :active="route().current('dashboard')" :href="route('dashboard')">
                                {{ $t('nav.dashboard') }}
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :active="$page.component.startsWith('Medicine/')"
                                               :href="route('medicine.index')">
                                {{ $t('nav.medicine') }}
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :active="$page.component.startsWith('BloodSugarReading/')"
                                               :href="route('bloodSugarReading.index')">
                                {{ $t('nav.blood_sugar_reading') }}
                            </ResponsiveNavLink>
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink :href="route('profile.edit')"> {{
                                        $t('nav.profile')
                                    }}
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('logout')" as="button" method="post">
                                    {{ $t('nav.logout') }}
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header"/>
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot/>
                </main>
            </div>
        </div>
    </AppLayout>
</template>
