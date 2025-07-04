<template>
    <header class="flex items-center bg-blue-200/5 px-[.8em] border-b w-full h-[1.8em]">
        <TopBarSideGroup class="flex flex-row items-center gap-[.8em]">
            <QueseraLogoSmall />
        </TopBarSideGroup>
        <TopBarCenterGroup>
            <TopBarClock :timezone="timezoneCurrent" />
            <!-- <small class="tracking-wide">Welcome, [SI-000128] David</small> -->
        </TopBarCenterGroup>
        <TopBarSideGroup class="flex flex-row-reverse items-center gap-[.8em]">
            <Settings :size="16" />
            <UserCircle :size="16" />
            <PanelRight :size="16" />
            <PanelBottom :size="16" />
            <PanelLeft :size="16" />
        </TopBarSideGroup>
    </header>
</template>

<script setup lang="ts">
import { PanelLeft, PanelBottom, PanelRight, UserCircle, Settings } from 'lucide-vue-next';
import QueseraLogoSmall from './QueseraLogoSmall.vue';
import TopBarSideGroup from './QueseraTopBarSideGroup.vue';
import TopBarCenterGroup from './QueseraTopBarCenterGroup.vue';
import TopBarClock from './QueseraTopBarClock.vue';

const timezoneCurrent = "Asia/Jakarta";

</script>