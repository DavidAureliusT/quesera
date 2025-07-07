<template>
    <header class="flex items-center bg-blue-200/5 px-[.8em] border-b w-full h-[1.8em]">
        <TopBarSideGroup class="flex flex-row items-center gap-[.8em]">
            <Link href="/projects">
            <QueseraLogoSmall />
            </Link>
        </TopBarSideGroup>
        <TopBarCenterGroup>
            <TopBarClock :timezone="timezoneCurrent" />
            <!-- <small class="tracking-wide">Welcome, [SI-000128] David</small> -->
        </TopBarCenterGroup>
        <TopBarSideGroup class="flex flex-row-reverse items-center gap-[.4em]">
            <div class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                <Settings :size="16" />
            </div>
            <div class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                <UserCircle :size="16" />
            </div>
            <div class="bg-white/10 hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                <PanelRight :size="16" />
            </div>
            <div class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                <PanelBottom :size="16" />
            </div>
            <div class="bg-white/10 hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                <PanelLeft :size="16" />
            </div>
        </TopBarSideGroup>
    </header>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import { PanelLeft, PanelBottom, PanelRight, UserCircle, Settings } from 'lucide-vue-next';
import QueseraLogoSmall from './QueseraLogoSmall.vue';
import TopBarSideGroup from './QueseraTopBarSideGroup.vue';
import TopBarCenterGroup from './QueseraTopBarCenterGroup.vue';
import TopBarClock from './QueseraTopBarClock.vue';

const timezoneCurrent = "Asia/Jakarta";

</script>