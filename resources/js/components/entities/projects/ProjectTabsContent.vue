<script setup lang="ts">
defineProps<{
    value: string
}>()
</script>

<template>
    <div class="p-[.8em] overflow-y-scroll">
        <div v-if="$slots.default">
            <slot />
        </div>
        <div v-else class="place-items-center grid">{{ value }}</div>
    </div>
</template>