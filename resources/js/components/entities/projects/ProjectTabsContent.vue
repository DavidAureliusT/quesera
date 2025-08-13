<script setup lang="ts">
</script>

<template>
    <div class="bg-red-950 h-[calc(100vh-(7*1.8em))] overflow-y-scroll">
        <div v-if="$slots.default">
            <slot />
        </div>
    </div>
</template>