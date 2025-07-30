<script setup lang="ts">
import { useBottomPanelStatus } from '@/composables/useBottomPanelStatus';

const { bottomPanelStatus, updateBottomPanelStatus } = useBottomPanelStatus();

</script>

<template>
    <Transition name="overlay-fade" mode="out-in">
        <div v-if="bottomPanelStatus == 'open'">
            <div class="absolute inset-0 bg-black/90" @click="updateBottomPanelStatus('close')"></div>
            <div class="bottom-[2.4em] absolute inset-x-0 place-items-center grid">
                <div class="bg-(--background) drop-shadow border border-primary drop-shadow-primary/20 rounded-xl w-[60vw] overflow-y-scroll">
                    <div class="flex justify-between items-center px-[.8em] border-primary border-b h-[1.8em]">
                        <p class="font-bold text-[.6em] uppercase">Diagnostic</p>
                    </div>
                    <slot />
                </div>
            </div>
        </div>
    </Transition>
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

.overlay-fade-enter-active,
.overlay-fade-leave-active {
    transition: all .01s ease-in-out;
}

.overlay-fade-enter-from {
    opacity: 0;
}

.overlay-fade-leave-to {
    opacity: 0;
}
</style>