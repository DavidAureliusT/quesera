<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
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
            <QueseraProjectContent :project="project" />
            <!-- <template #side>
                <pre class="text-[.8em]">{{ page.props }}</pre>
            </template> -->
        </QueseraContent>
    </QueseraShell>
</template>