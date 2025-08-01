<script setup lang="ts">
defineProps<{
    title: string,
    isActive?: boolean
}>()
</script>

<template>
    <div class="hover:bg-primary px-[.4em] border border-dashed rounded font-bold text-[.8em] cursor-pointer" :class="{ 'bg-primary ': isActive, 'bg-primary/5': !isActive }">{{ title }}</div>
</template>