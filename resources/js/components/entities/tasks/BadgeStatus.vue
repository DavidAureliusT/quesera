<script setup lang="ts">
// import { computed } from "vue";
import { Badge } from '@/components/ui/badge';

defineProps<{ status_category: string, status_name: string }>()

const classesStatusCategory: Record<string, string> = {
    'To do': 'bg-white/30 overflow-clip text-white/80',
    'In Progress': 'bg-process/30 overflow-clip text-process/80',
    'Done': 'bg-primary/30 overflow-clip text-primary/80',
}
</script>

<template>
    <Badge :class="classesStatusCategory[status_category]" class="mb-[.1em] px-[.8em] py-[.2em] rounded-sm text-[.7em] uppercase leading-[1em]">{{ status_name }}</Badge>
</template>