<script setup lang="ts">
import { useBottomPanelStatus } from '@/composables/useBottomPanelStatus';
import { PanelBottom } from 'lucide-vue-next';

const { bottomPanelStatus, updateBottomPanelStatus } = useBottomPanelStatus();

</script>

<template>
    <div>
        <div v-if="bottomPanelStatus == 'close'" @click="updateBottomPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
            <PanelBottom :size="16" />
        </div>
        <div v-else @click="updateBottomPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
            <PanelBottom :size="16" class="text-primary" />
        </div>
    </div>
</template>