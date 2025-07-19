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

<template>
    <Toaster />

    <Head title="Projects" />
    <QueseraShell>
        <template #rightSide>
            <QueseraNavProject />
        </template>
        <template #center v-if="project">
            <QueseraContentProject :project="project" />
        </template>
        <template #leftSide>
            <div class="flex flex-col">
                <div class="flex justify-between items-center px-[.8em] border-b h-[1.8em]">
                    <p class="font-bold text-[.6em] text-white/50 uppercase">Diagnostic</p>
                </div>
                <div class="bg-black p-[.8em] h-[calc(100vh-(3*1.8em))] overflow-y-scroll">
                    <pre>{{ page.props.auth }}</pre>
                </div>
            </div>
        </template>
    </QueseraShell>
</template>