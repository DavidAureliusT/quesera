<script setup lang="ts">
import { SharedProps } from '@/types';

import NavProject from '@/components/entities/projects/Nav.vue';
import AppShell from '@/components/AppShell.vue';
import ProjectViewProvider from "@/components/entities/projects/ProjectRoot.vue";

const sharedProps = defineProps<SharedProps>();

</script>

<template>
    <AppShell>
        <template #rightSide>
            <NavProject />
        </template>
        <template #center>
            <ProjectViewProvider :project="sharedProps.project" />
        </template>
        <template #leftSide>
        </template>
    </AppShell>
</template>