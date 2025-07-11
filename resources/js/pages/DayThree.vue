<template>
    <Toaster />

    <Head title="Projects" />
    <QueseraShell>
        <QueseraTopBar />
        <QueseraContent>
            <template v-if="!!isOpenLeftPanel" #leftSide>
                <QueseraNavProject />
            </template>
            <template #center v-if="project">
                <QueseraContentProject :project="project" />
            </template>
            <template v-if="!!isOpenRightPanel" #rightSide>
                <!-- <QueseraEventFocus /> -->
            </template>
        </QueseraContent>
        <div class="flex-1 bg-black border-t">
            <div class="flex">
                <div class="w-[16em]"></div>
                <div class="flex-1 text-center">
                    <QueseraBottomBarShortcut />
                </div>
                <div class="w-[16em]">
                </div>
            </div>
        </div>
    </QueseraShell>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Project } from '@/types';

import Toaster from '@/components/ui/toast/Toaster.vue'
import QueseraShell from './quesera/QueseraShell.vue';
import QueseraTopBar from './quesera/QueseraTopBar.vue';
import QueseraContent from './quesera/QueseraContent.vue';
import QueseraContentProject from './quesera/QueseraContentProject.vue';
import QueseraNavProject from './quesera/QueseraNavProject.vue';
// import QueseraEventFocus from './quesera/QueseraEventFocus.vue';

import { useLeftPanel } from '@/composables/useLeftPanel';
import { useRightPanel } from '@/composables/useRightPanel';
import QueseraBottomBarShortcut from './quesera/QueseraBottomBarShortcut.vue';

interface Props {
    project?: Project
}

defineProps<Props>();

const { isOpenLeftPanel } = useLeftPanel();
const { isOpenRightPanel } = useRightPanel();


</script>