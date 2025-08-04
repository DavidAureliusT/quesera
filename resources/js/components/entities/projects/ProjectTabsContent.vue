<script setup lang="ts">
</script>

<template>
    <div class="p-[.8em] overflow-y-scroll">
        <div v-if="$slots.default">
            <slot />
        </div>
    </div>
</template>