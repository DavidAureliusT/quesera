<template>
    <Toaster />

    <Head title="Projects" />
    <QueseraShell>
        <template #leftSide>
            <QueseraNavProject />
        </template>
        <template #center v-if="project">
            <QueseraContentProject :project="project" />
        </template>
        <template #rightSide>
            <pre>{{ page }}</pre>
        </template>

    </QueseraShell>
</template>

<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { Project } from '@/types';

import Toaster from '@/components/ui/toast/Toaster.vue'
import QueseraShell from './quesera/QueseraShell.vue';
import QueseraContentProject from './quesera/QueseraContentProject.vue';
import QueseraNavProject from './quesera/QueseraNavProject.vue';


interface Props {
    project?: Project
}

defineProps<Props>();

const page = usePage();

</script>