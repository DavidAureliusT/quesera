<script setup lang="ts">
// import { usePage } from '@inertiajs/vue3';
import WorldClock from '@/components/WorldClock.vue';

</script>

<template>
    <div class="flex flex-col justify-center items-center gap-6 bg-background p-6 md:p-10 min-h-svh">
        <h1>Day One</h1>
        <div class="flex divide-x-[.08em] divide-white">
            <section class="flex flex-col flex-none items-center px-[1.8em] py-[.4em] w-[30em]">
                <WorldClock location="New York" timezone="America/New_York" />
            </section>
            <section class="flex flex-col flex-none items-center px-[1.8em] py-[.4em] w-[30em]">
                <WorldClock location="London" timezone="Europe/London" />
            </section>
            <section class="flex flex-col flex-none items-center px-[1.8em] py-[.4em] w-[30em]">
                <WorldClock location="Tokyo" timezone="Asia/Tokyo" />
            </section>
        </div>
    </div>
</template>