<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { Project } from '@/types';
import Toaster from '@/components/ui/toast/Toaster.vue'
import QueseraTopBar from './quesera/QueseraTopBar.vue';
import QueseraContent from './quesera/QueseraContent.vue';
import QueseraShell from './quesera/QueseraShell.vue';
import QueseraProjectContent from './projects/QueseraProjectContent.vue';
import { Rocket } from 'lucide-vue-next';
import QueseraProjectList from './quesera/QueseraProjectList.vue';


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
        <QueseraTopBar />

        <QueseraContent :project="project">
            <template #leftSide>
                <QueseraProjectList />
            </template>
            <QueseraProjectContent v-if="project" :project="project" />
            <div v-else class="place-items-center grid h-[calc(100vh-1.8em)]">
                <div class="text-[.8em]">
                    <Rocket :size="253" class="opacity-10" />
                </div>
            </div>
            <template #rightSide>
                <pre class="text-[.8em]">{{ page.url }}</pre>
                <pre class="text-[.8em]">{{ page.props.compas.projectItems }}</pre>
            </template>
        </QueseraContent>
    </QueseraShell>
</template>