<script setup lang="ts">
import AppBarTop from '@/components/AppBarTop.vue';
import AppPanelBottom from '@/components/AppPanelBottom.vue';
import AppBarBottom from '@/components/AppBarBottom.vue';

import Toaster from '@/components/ui/toast/Toaster.vue'

import { useLeftPanelStatus } from '@/composables/useLeftPanelStatus';
import { useRightPanelStatus } from '@/composables/useRightPanelStatus';

const { leftPanelStatus } = useLeftPanelStatus();
const { rightPanelStatus } = useRightPanelStatus();

</script>

<template>
    <Toaster />
    <div class="relative border h-screen overflow-clip">
        <div class="flex flex-col">
            <AppBarTop />
            <div class="flex flex-1 divide-x divide-dashed w-full">
                <div v-if="leftPanelStatus == 'open'" class="w-[16em] h-[calc(100vh-(2*1.8em))] overflow-y-scroll">
                    <slot name="leftSide" />
                </div>
                <div class="flex-1 h-[calc(100vh-3.6em)] overflow-y-scroll">
                    <slot name="center" />
                </div>
                <div v-if="rightPanelStatus == 'open'" class="bg-black w-[16em] h-[calc(100vh-3.6em)] overflow-y-scroll">
                    <slot name="rightSide" />
                </div>
            </div>
            <AppBarBottom />
        </div>
        <AppPanelBottom>
            <slot name="bottomPanel" />
        </AppPanelBottom>
    </div>
</template>