<template>
    <div class="h-[calc(100vh-(7*1.8em))] overflow-y-scroll">
        <div v-if="$slots.default">
            <slot />
        </div>
    </div>
</template>