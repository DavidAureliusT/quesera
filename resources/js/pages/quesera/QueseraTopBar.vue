<template>
    <header class="flex items-center px-[.8em] border-b w-full h-[1.8em]">
        <TopBarSideGroup class="flex flex-row items-center gap-[.8em]">
            <QueseraLogoSmall />
            <PanelLeft :size="16" />
        </TopBarSideGroup>
        <TopBarCenterGroup>
            <TopBarClock :timezone="timezoneCurrent" />
        </TopBarCenterGroup>
        <TopBarSideGroup class="flex flex-row-reverse">
            <small class="p-[.8em] tracking-wide">Welcome, [SI-000128] David</small>
        </TopBarSideGroup>
    </header>
</template>

<script setup lang="ts">
import { PanelLeft } from 'lucide-vue-next';
import QueseraLogoSmall from './QueseraLogoSmall.vue';
import TopBarSideGroup from './QueseraTopBarSideGroup.vue';
import TopBarCenterGroup from './QueseraTopBarCenterGroup.vue';
import TopBarClock from './QueseraTopBarClock.vue';

const timezoneCurrent = "Asia/Jakarta";

</script>