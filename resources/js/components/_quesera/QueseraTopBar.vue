<template>
    <header class="flex items-center bg-neutral-900 px-[.8em] border-b w-full h-[1.8em]">
        <TopBarSideGroup>
            <Link href="/projects">
            <AppLogoIcon class="size-3" />
            </Link>
        </TopBarSideGroup>
        <TopBarCenterGroup>
            <TopBarClock :timezone="timezoneCurrent" />
        </TopBarCenterGroup>
        <TopBarSideGroup class="flex flex-row-reverse items-center gap-[.4em]">
            <div class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                <Settings :size="16" />
            </div>

            <div>
                <div v-if="rightPanelStatus == 'close'" @click="updateRightPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelRight :size="16" />
                </div>
                <div v-else @click="updateRightPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelRight :size="16" class="text-primary" />
                </div>
            </div>
            <div>
                <div v-if="bottomPanelStatus == 'close'" @click="updateBottomPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelBottom :size="16" />
                </div>
                <div v-else @click="updateBottomPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelBottom :size="16" class="text-primary" />
                </div>
            </div>
            <div>
                <div v-if="leftPanelStatus == 'close'" @click="updateLeftPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelLeft :size="16" />
                </div>
                <div v-else @click="updateLeftPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelLeft :size="16" class="text-primary" />
                </div>
            </div>

        </TopBarSideGroup>
    </header>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import {
    PanelLeft, PanelBottom, PanelRight, Settings
} from 'lucide-vue-next';

// import QueseraLogoSmall from './QueseraLogoSmall.vue';
import TopBarSideGroup from './QueseraTopBarSideGroup.vue';
import TopBarCenterGroup from './QueseraTopBarCenterGroup.vue';
import TopBarClock from './QueseraTopBarClock.vue';
import { useLeftPanelStatus } from '@/composables/useLeftPanelStatus';
import { useRightPanelStatus } from '@/composables/useRightPanelStatus';
import { useBottomPanelStatus } from '@/composables/useBottomPanelStatus';


import AppLogoIcon from '@/components/AppLogoIcon.vue';


const timezoneCurrent = "Asia/Jakarta";

const { leftPanelStatus, updateLeftPanelStatus } = useLeftPanelStatus();
const { rightPanelStatus, updateRightPanelStatus } = useRightPanelStatus();
const { bottomPanelStatus, updateBottomPanelStatus } = useBottomPanelStatus();



</script>