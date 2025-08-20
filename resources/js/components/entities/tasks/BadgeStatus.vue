<script setup lang="ts">
// import { computed } from "vue";
import { Badge } from '@/components/ui/badge';

defineProps<{ status_category: string, status_name: string }>()

const classesStatusCategory: Record<string, string> = {
    'To do': 'bg-black border-2 border-white overflow-clip text-white',
    'In Progress': 'bg-black border-2 border-process overflow-clip text-process',
    'Done': 'bg-black border-2 border-primary overflow-clip text-primary',
}
</script>

<template>
    <Badge :class="classesStatusCategory[status_category]" class="mb-[.1em] px-[.8em] py-[.3em] rounded-full h-fit text-[.7em] uppercase leading-[1em]">{{ status_name }}</Badge>
</template>