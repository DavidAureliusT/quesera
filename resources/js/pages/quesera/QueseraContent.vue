<template>
    <div class="flex flex-1 divide-x w-full">
        <div v-if="$slots.leftSide" class="bg-blue-200/5 w-[16em] h-[calc(100vh-1.8em)] overflow-y-scroll">
            <slot name="leftSide" />
        </div>
        <div class="flex-1 h-[calc(100vh-1.8em)] overflow-y-scroll">
            <slot />
        </div>
        <div v-if="$slots.rightSide" class="bg-blue-200/5 w-[16em] h-[calc(100vh-1.8em)] overflow-y-scroll">
            <slot name="rightSide" />
        </div>
    </div>
</template>