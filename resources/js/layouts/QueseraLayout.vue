<script setup lang="ts">
import QueseraSidebarLayout from '@/layouts/app/QueseraSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <QueseraSidebarLayout :breadcrumbs="breadcrumbs">
        <slot />
    </QueseraSidebarLayout>
</template>