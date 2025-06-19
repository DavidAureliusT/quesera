<script setup lang="ts">
// import { Egg } from 'lucide-vue-next';

import { usePage } from '@inertiajs/vue3';

const page = usePage();

</script>

<template>
    <div class="flex justify-center items-center bg-sidebar-primary rounded-md size-8 aspect-square text-sidebar-primary-foreground">
        <p class="fill-current font-bold text-[1.2em] text-white dark:text-black uppercase">{{ page.props.name[0] }}</p>
        <!-- <Egg class="fill-current size-5 text-white dark:text-black/40" /> -->
    </div>
    <div class="flex-1 grid ml-1 text-sm text-left">
        <span class="mb-0.5 font-semibold truncate capitalize leading-tight">{{ page.props.name }}</span>
    </div>
</template>