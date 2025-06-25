<script setup lang="ts">
import { ChevronRight } from 'lucide-vue-next';

import WorldClockTable from '@/components/WorldClockTable.vue';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="relative flex flex-col justify-center items-center gap-6 bg-background p-6 md:p-10 min-h-svh">
        <div class="top-[2em] right-[2em] absolute">
            <Link :href="route('day-2')" class="flex hover:font-bold uppercase transition-all">
            Go to day-2
            <ChevronRight />
            </Link>
        </div>
        <div class="flex flex-col items-center">
            <h1>Day One</h1>
            <caption>Day & Night</caption>
        </div>
        <div>
            <WorldClockTable></WorldClockTable>
        </div>
    </div>
</template>