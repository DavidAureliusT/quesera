<template>
    <div class="flex flex-1 divide-x w-full">
        <div class="flex-1 h-[calc(100vh-1.8em)] overflow-y-scroll">
            <slot />
        </div>
        <div v-if="$slots.side" class="w-[16em] h-[calc(100vh-1.8em)] overflow-y-scroll">
            <slot name="side" />
        </div>
    </div>
</template>