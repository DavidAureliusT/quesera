<script setup lang="ts">
defineProps<{ indicatorName: string }>()
</script>

<template>
    <div :id="indicatorName" class="mt-[.3em] rounded-[10pt] h-[.2em]"></div>
</template>