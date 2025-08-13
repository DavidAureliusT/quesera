<script setup lang="ts">
defineProps<{
    title: string,
    isActive?: boolean
}>()
</script>

<template>
    <div class="p-[.4em] px-[1.2em] last:border-r border-dashed text-[.8em] cursor-pointer" :class="{ 'font-black text-white': isActive, 'font-black text-white/50': !isActive }">{{ title }}</div>
</template>