<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import QueseraTopBar from './QueseraTopBar.vue';
import QueseraBottomBar from './QueseraBottomBar.vue';
import { Bean } from 'lucide-vue-next';
import { useLeftPanelStatus } from '@/composables/useLeftPanelStatus';
import { useRightPanelStatus } from '@/composables/useRightPanelStatus';
import { useBottomPanelStatus } from '@/composables/useBottomPanelStatus';

const { leftPanelStatus } = useLeftPanelStatus();
const { rightPanelStatus } = useRightPanelStatus();
const { bottomPanelStatus } = useBottomPanelStatus();

const page = usePage();

</script>

<template>
    <div class="relative border-2 rounded-xl h-screen overflow-clip">
        <div class="flex flex-col">
            <QueseraTopBar />
            <div class="flex flex-1 divide-x w-full">
                <div v-if="leftPanelStatus == 'open'" class="w-[16em] h-[calc(100vh-(2*1.8em))] overflow-y-scroll">
                    <slot name="leftSide" />
                </div>
                <div class="flex-1 h-[calc(100vh-3.6em)] overflow-y-scroll">
                    <div v-if="$slots.center">
                        <slot name="center" />
                    </div>
                    <div v-else class="place-items-center grid h-[calc(100vh-3.6em)]">
                        <div class="text-[1.0em]">
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
        <Transition name="slide-fade" mode="out-in">
            <div v-if="bottomPanelStatus == 'open'" class="bottom-[2.4em] absolute inset-x-0 place-items-center grid">
                <div class="bg-(--background) drop-shadow-lg drop-shadow-white/20 p-[.8em] border border-white/50 rounded-[1.2em] w-[60vw] h-[10em]">
                    <pre>{{ page.props.auth.user }}</pre>
                </div>
            </div>
        </Transition>
    </div>
</template>


<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease-in-out;
}

.slide-fade-enter-from {
    transform: translateY(100%);
    opacity: 0;
}

.slide-fade-leave-to {
    transform: translateY(100%);
    opacity: 0;
}
</style>