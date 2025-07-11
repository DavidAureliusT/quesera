<template>
    <div class="flex flex-1 divide-x w-full">
        <div v-if="$slots.leftSide" class="w-[16em] h-[calc(100vh-3.6em)] overflow-y-scroll">
            <slot name="leftSide" />
        </div>
        <div class="flex-1 h-[calc(100vh-3.6em)] overflow-y-scroll">
            <slot name="center" v-if="$slots.center" />
            <div v-else class="place-items-center grid h-[calc(100vh-3.6em)]">
                <div class="text-[.8em]">
                    <Bean :size="253" class="opacity-10 blur-xs" />
                </div>
            </div>
        </div>
        <div v-if="$slots.rightSide" class="w-[16em] h-[calc(100vh-3.6em)] overflow-y-scroll">
            <slot name="rightSide" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { Bean } from 'lucide-vue-next';
</script>