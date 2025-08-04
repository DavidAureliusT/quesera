<script setup lang="ts">
// import { computed } from "vue";
import { Badge } from '@/components/ui/badge';

defineProps<{ status_category: string, status_name: string }>()

const classesStatusCategory: Record<string, string> = {
    'To do': 'bg-white text-black',
    'In Progress': 'bg-process text-black',
    'Done': 'bg-primary text-black'
}
</script>

<template>
    <Badge :class="classesStatusCategory[status_category]" class="mb-[.1em] px-[.8em] py-[.2em] rounded w-full font-bold text-[.7em] uppercase leading-[1em] cursor-pointer">{{ status_name }}</Badge>
</template>