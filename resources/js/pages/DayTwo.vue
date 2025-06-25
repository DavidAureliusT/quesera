<script setup lang="ts">
import QueseraLayout from '@/layouts/QueseraLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import WorldClockTable from '@/components/WorldClockTable.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Day-2',
        href: '/day-2',
    },
];
</script>

<template>

    <Head title="Dashboard" />
    <QueseraLayout :breadcrumbs="breadcrumbs">
        <div class="pt-[3em] h-screen overflow-y-scroll">
            <div class="flex flex-col items-start px-[.8em] md:px-[1em]">
                <h1>Day Two</h1>
                <caption>Sky & Sea</caption>
            </div>
            <div class="mt-[1.2em]">
                <WorldClockTable></WorldClockTable>
            </div>
        </div>
    </QueseraLayout>
</template>