<script setup lang="ts">
// import { usePage } from '@inertiajs/vue3';
// import WorldClock from '@/components/WorldClock.vue';
import WorldClockTable from '@/components/WorldClockTable.vue';

</script>

<template>
    <div class="flex flex-col justify-center items-center gap-6 bg-background p-6 md:p-10 min-h-svh">
        <h1>Day One</h1>
        <!-- <div class="grid grid-cols-4 max-w-3xl">
            <section class="flex flex-col flex-none items-center px-[1.8em] py-[.4em] aspect-square">
                <div class="place-items-center grid h-full">
                    <WorldClock location="Jakarta" timezone="Asia/Jakarta" />
                </div>
            </section>
            <section class="flex flex-col flex-none items-center px-[1.8em] py-[.4em] aspect-square">
                <div class="place-items-center grid h-full">
                    <WorldClock location="New York" timezone="America/New_York" />
                </div>
            </section>
            <section class="flex flex-col flex-none items-center px-[1.8em] py-[.4em] aspect-square">
                <div class="place-items-center grid h-full">
                    <WorldClock location="London" timezone="Europe/London" />
                </div>
            </section>
            <section class="flex flex-col flex-none items-center px-[1.8em] py-[.4em] aspect-square">
                <div class="place-items-center grid h-full">
                    <WorldClock location="Tokyo" timezone="Asia/Tokyo" />
                </div>
            </section>
        </div> -->
        <div>
            <WorldClockTable></WorldClockTable>
        </div>
    </div>
</template>