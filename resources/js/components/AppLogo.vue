<script setup lang="ts">
// import { Egg } from 'lucide-vue-next';
import { usePage } from '@inertiajs/vue3';
import AppLogoIcon from './AppLogoIcon.vue';

const page = usePage();

</script>

<template>
    <AppLogoIcon />
    <div class="flex-1 grid ml-1 text-sm text-left">
        <span class="mb-0.5 font-semibold truncate capitalize leading-tight">{{ page.props.name }}</span>
    </div>
</template>