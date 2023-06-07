<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>&nbsp;
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                    <Link :href="route('listing.index')">LaraZillow</Link>
                </div>
                <div v-if="user" class="flex items-center gap-4">
                    <div class="text-sm text-gray-500">
                        <Link :href="route('realtor.listing.index')">{{user.name}}</Link>
                    </div>
                    <Link :href="route('realtor.listing.create')" class="button-primary">+ New Listing</Link>
                    <div>
                        <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                    </div>
                </div>
                <div v-else class="flex items-center gap-1">
                    <Link :href="route('user-account.create')">Register |</Link>
                    <Link :href="route('login')">Sign-In</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess" class="input-success">
            {{ flashSuccess }}
        </div>
        <slot>
            Default
        </slot>
    </main>
</template>
<script setup>
import {Link, usePage} from '@inertiajs/inertia-vue3'
import {ref, computed} from 'vue'

//page.props.value.flash.success
const page = usePage();
const flashSuccess = computed(
    () => page.props.value.flash.success,
)

const user = computed(
    () => page.props.value.user,
)

const timer = ref(0)

setInterval(() => timer.value++, 1000)
</script>
