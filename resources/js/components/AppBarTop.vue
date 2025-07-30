<script setup lang="ts">

import { useWorldClock } from '@/composables/useWorldClock';
import ButtonHome from '@/actions/ButtonHome.vue';
import ButtonSettings from '@/actions/ButtonSettings.vue';
import TogglerRightPanel from '@/actions/TogglerRightPanel.vue';
import TogglerLeftPanel from '@/actions/TogglerLeftPanel.vue';
import TogglerBottomPanel from '@/actions/TogglerBottomPanel.vue';

const timezoneCurrent = "Asia/Jakarta";

const { currentTime, timeZoneAbbr } = useWorldClock(timezoneCurrent)

const sideWidthClass = 'w-[16em]';

</script>

<template>
    <header class="flex items-center bg-neutral-900 px-[.8em] border-b w-full h-[1.8em]">
        <div :class="sideWidthClass" class="flex">
            <ButtonHome />
        </div>
        <div class="flex-1 place-items-center grid">
            <small class="p-[.8em] tracking-wide">
                [{{ timeZoneAbbr }}] ({{ timezoneCurrent }}) {{ currentTime.toLocaleTimeString('EN', { timeStyle: "medium" }) }}, {{ currentTime.toLocaleDateString('EN', { dateStyle: "full" }) }}
            </small>
        </div>
        <div :class="sideWidthClass" class="flex flex-row-reverse items-center gap-[.4em]">
            <ButtonSettings />
            <TogglerRightPanel />
            <TogglerBottomPanel />
            <TogglerLeftPanel />
        </div>
    </header>
</template>