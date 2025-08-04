<script setup lang="ts">
import { Bean } from 'lucide-vue-next';
</script>

<template>
    <div class="place-items-center grid h-[calc(100vh-3.6em)]">
        <div class="flex flex-col items-center gap-2">
            <Bean :size="253" class="opacity-10 blur-[2px] text-foreground" />
            <div class="flex gap-2 text-[1.0em]">
                <p class="opacity-50 font-medium text-right">Toggle Left Panel</p>
                <div class="place-items-center grid bg-foreground/20 rounded w-[2.4em] aspect-square font-bold text-[.6em] text-primary">[</div>
            </div>
            <div class="flex gap-2 text-[1.0em]">
                <p class="opacity-50 font-medium text-right">Toggle Right Panel</p>
                <div class="place-items-center grid bg-foreground/20 rounded w-[2.4em] aspect-square font-bold text-[.6em] text-primary">]</div>
            </div>
            <div class="flex gap-2 text-[1.0em]">
                <p class="opacity-50 font-medium text-right">Toggle Bottom Panel</p>
                <div class="place-items-center grid bg-foreground/20 rounded w-[2.4em] aspect-square font-bold text-[.6em] text-primary">\\</div>
            </div>
        </div>
    </div>
</template>