<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { Project } from '@/types';
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

    <Head title="Projects" />
    <QueseraShell>
        <QueseraTopBar />
        <QueseraContent :project="project">
            <template #side>
                <pre class="text-[.8em]">{{ page.props.compas }}</pre>
                <pre class="text-[.8em]">{{ project }}</pre>
            </template>
            <QueseraProjectContent :project="project" />
        </QueseraContent>
    </QueseraShell>
</template>