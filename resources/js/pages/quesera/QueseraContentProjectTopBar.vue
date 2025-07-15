<script setup lang="ts">
defineProps<{ project_type: string }>()
</script>

<template>
    <div class="flex justify-between items-center pl-[.8em] border-b h-[1.8em]">
        <p class="font-bold text-[.6em] text-white/50 uppercase">{{ project_type }}'s Project</p>
    </div>
</template>