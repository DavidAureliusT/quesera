<template>
    <div class="flex flex-col h-screen">
        <QueseraTopBar />

        <div class="flex flex-1 divide-x w-full">

            <div v-if="leftPanelStatus == 'open'" class="w-[16em] h-[calc(100vh-3.6em)] overflow-y-scroll">
                <slot name="leftSide" />
            </div>
            <div class="flex-1 h-[calc(100vh-3.6em)] overflow-y-scroll">

                <div v-if="$slots.center">
                    <slot name="center" />
                </div>

                <div v-else class="place-items-center grid h-[calc(100vh-3.6em)]">
                    <div class="text-[.8em]">
                        <Bean :size="253" class="opacity-10 blur-xs" />
                    </div>
                </div>

            </div>
            <div v-if="rightPanelStatus == 'open'" class="w-[16em] h-[calc(100vh-3.6em)] overflow-y-scroll">
                <slot name="rightSide" />
            </div>

        </div>
        <QueseraBottomBar />
    </div>
</template>

<script setup lang="ts">
import QueseraTopBar from './QueseraTopBar.vue';
import QueseraBottomBar from './QueseraBottomBar.vue';

import { Bean } from 'lucide-vue-next';
import { useLeftPanelStatus } from '@/composables/useLeftPanelStatus';
import { useRightPanelStatus } from '@/composables/useRightPanelStatus';

const { leftPanelStatus } = useLeftPanelStatus();
const { rightPanelStatus } = useRightPanelStatus();

</script>