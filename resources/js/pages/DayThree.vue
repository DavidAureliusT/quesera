<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Project } from '@/types';
import Toaster from '@/components/ui/toast/Toaster.vue'
import QueseraTopBar from './quesera/QueseraTopBar.vue';
import QueseraContent from './quesera/QueseraContent.vue';
import QueseraShell from './quesera/QueseraShell.vue';
import QueseraProjectContent from './projects/QueseraProjectContent.vue';

interface Props {
    project: Project
}

defineProps<Props>();

const page = usePage();

</script>

<template>
    <Toaster />

    <Head title="Projects" />
    <QueseraShell>
        <QueseraTopBar />

        <QueseraContent :project="project">
            <template #leftSide>
                <div class="px-[.8em] py-[.3em]">
                    <p class="font-bold text-[.6em] text-white/50 uppercase">Projects</p>
                </div>
                <Link v-for="(item, index) in page.props.compas.projectItems" :key="index" :class="{
                    'flex flex-row hover:bg-white/20 px-[.8em] py-[.2em]': true,
                    'bg-white/10': item.key == project.key
                }" :href="'/projects/' + item.key">
                <div class="w-[3em]">
                    <p class="opacity-50 font-mono text-[.8em]">{{ item.key }}</p>
                </div>
                <div class="flex-1">
                    <p class="text-[.8em]">{{ item.name }}</p>
                </div>
                </Link>
            </template>
            <QueseraProjectContent :project="project" />
            <template #rightSide>
                <pre class="text-[.8em]">{{ page.props.compas }}</pre>
            </template>
        </QueseraContent>
    </QueseraShell>
</template>