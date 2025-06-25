<script setup lang="ts">
import QueseraContent from '@/components/QueseraContent.vue';
import AppShell from '@/components/AppShell.vue';
import QueseraSidebar from '@/components/QueseraSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <QueseraSidebar />
        <QueseraContent variant="sidebar">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <slot />
        </QueseraContent>
    </AppShell>
</template>