<script setup lang="ts">
import { SharedProps } from '@/types';

import NavProject from '@/components/entities/projects/Nav.vue';
import AppShell from '@/components/AppShell.vue';
import ProjectRoot from "@/components/entities/projects/ProjectRoot.vue";

const sharedProps = defineProps<SharedProps>();

</script>

<template>
    <AppShell>
        <template #rightSide>
            <NavProject />
        </template>
        <template #center>
            <ProjectRoot :project="sharedProps.project" />
        </template>
        <template #leftSide>
            <!-- <div class="flex flex-col">
                <div class="flex justify-between items-center px-[.8em] border-b border-dashed h-[1.8em]">
                    <p class="font-bold text-[.6em] text-white/50 uppercase">Diagnostic</p>
                </div>
                <div class="bg-black p-[.8em] h-[calc(100vh-(3*1.8em))] overflow-y-scroll">
                    <pre>{{ page.props.compas }}</pre>
                </div>
            </div> -->
        </template>
    </AppShell>
</template>