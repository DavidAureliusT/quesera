<script setup lang="ts">
import { useLeftPanelStatus } from '@/composables/useLeftPanelStatus';
import { PanelRight } from 'lucide-vue-next';

const { leftPanelStatus, updateLeftPanelStatus } = useLeftPanelStatus();

</script>

<template>
    <div>
        <div v-if="leftPanelStatus == 'close'" @click="updateLeftPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
            <PanelRight :size="16" />
        </div>
        <div v-else @click="updateLeftPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
            <PanelRight :size="16" class="text-primary" />
        </div>
    </div>
</template>