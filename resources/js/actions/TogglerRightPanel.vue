<script setup lang="ts">
import { useRightPanelStatus } from '@/composables/useRightPanelStatus';
import { PanelRight } from 'lucide-vue-next';

const { rightPanelStatus, updateRightPanelStatus } = useRightPanelStatus();

</script>

<template>
    <div>
        <div v-if="rightPanelStatus == 'close'" @click="updateRightPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
            <PanelRight :size="16" />
        </div>
        <div v-else @click="updateRightPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
            <PanelRight :size="16" class="text-primary" />
        </div>
    </div>
</template>