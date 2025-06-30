<template>
    <header class="flex items-center border-b w-full h-[1.8em]">
        <TopBarSideGroup>
            <QueseraLogoSmall />
        </TopBarSideGroup>
        <TopBarCenterGroup>
            <TopBarClock :timezone="timezoneCurrent" />
        </TopBarCenterGroup>
        <TopBarSideGroup class="place-items-end grid">
            <small class="p-[.8em] tracking-wide">Welcome, [SI-000128] David</small>
        </TopBarSideGroup>
    </header>
</template>

<script setup lang="ts">
import QueseraLogoSmall from './QueseraLogoSmall.vue';
import TopBarSideGroup from './QueseraTopBarSideGroup.vue';
import TopBarCenterGroup from './QueseraTopBarCenterGroup.vue';
import TopBarClock from './QueseraTopBarClock.vue';

const timezoneCurrent = "Asia/Jakarta";

</script>