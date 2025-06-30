<template>
    <div :class="cn('flex-1 place-items-center grid', props.class)">
        <slot />
    </div>
</template>

<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

interface Props {
    class?: HTMLAttributes['class']
}
const props = defineProps<Props>()
</script>