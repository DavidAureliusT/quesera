<template>
    <div :id="task.key + '-card'" draggable="true" @dragstart="(e) => onDragStartHandler(e, task)" @dragend="(e) => onDragEndHandler(e)" class="p-[.2em]">
        <div class="relative bg-black border rounded-[.8em] overflow-clip">
            <div :class="{ 'onDragOverAsPrev': isDragoverOnPrev, 'onDragOverAsNext': isDragoverOnNext }" class="-z-10 absolute inset-0 flex flex-col border-y border-transparent text-foreground" @dragleave="onDragLeaveHandler">
                <div class="flex-1 place-items-center grid" @dragover="(e) => onDragOverHandler(e, task, 'previous')">
                </div>
                <div class="flex-1 place-items-center grid" @dragover="(e) => onDragOverHandler(e, task, 'next')">
                </div>
            </div>
            <div :class="{
                'opacity-50': isDragging,
                'border-white/30 bg-white/5 text-white/80': 'To do' == task.status_category,
                'border-process/30 bg-process/5 text-process/80': 'In Progress' == task.status_category,
                'border-primary/30 bg-primary/5 text-primary/80': 'Done' == task.status_category,
            }" class="transition-all cursor-pointer">
                <div class="p-[.8em]">
                    <div class="flex flex-row justify-between items-center">
                        <p><span class="text-white/50">{{ task.key }}</span></p>
                        <div class="place-items-center grid border rounded-full w-[1.8em] aspect-square leading-0"></div>
                    </div>
                    <p>{{ task.summary }}</p>
                </div>
                <div class="flex justify-between px-[.8em] py-[.4em] border-t">
                    <p><span class="text-white/50">Point:</span> {{ task.point }}</p>
                    <p><span class="text-white/50">on-drag:</span> {{ isDragging }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Task } from '@/types';

defineProps<{ task: Task }>()

const isDragging = ref<boolean>(false);
const isDragoverOnPrev = ref<boolean>(false);
const isDragoverOnNext = ref<boolean>(false);

const onDragStartHandler = (event: DragEvent, task: Task) => {
    isDragging.value = true;
    if (event.target instanceof HTMLElement && event.dataTransfer) {
        event.dataTransfer.clearData();
        event.dataTransfer.setData('text', task.key);
    }
}

const onDragOverHandler = (event: DragEvent, taskOver: Task, position: 'previous' | 'next') => {
    event.preventDefault();
    if (position == 'previous') {
        isDragoverOnPrev.value = true;
        isDragoverOnNext.value = false;

    }
    if (position == 'next') {
        isDragoverOnPrev.value = false;
        isDragoverOnNext.value = true;
    }
}

const onDragLeaveHandler = (event: DragEvent) => {
    event.preventDefault();
    isDragoverOnPrev.value = false;
    isDragoverOnNext.value = false;
}

const onDragEndHandler = (event: DragEvent) => {
    event.preventDefault();
    isDragging.value = false;
    isDragoverOnPrev.value = false;
    isDragoverOnNext.value = false;

    clearAllIndicator();
}

const clearAllIndicator = () => {
    const onDragOverAsPrevElements = document.getElementsByClassName('onDragOverAsPrev');
    const onDragOverAsPrevArray = Array.from(onDragOverAsPrevElements);
    onDragOverAsPrevArray.forEach(element => {
        element.classList.remove('onDragOverAsPrev');
    });

    const onDragOverAsNextElements = document.getElementsByClassName('onDragOverAsNext');
    const onDragOverAsNextArray = Array.from(onDragOverAsNextElements);
    onDragOverAsNextArray.forEach(element => {
        element.classList.remove('onDragOverAsNext');
    });

    const onDragOverColumnElements = document.getElementsByClassName('onDragOverColumn');
    const onDragOverColumnArray = Array.from(onDragOverColumnElements);
    onDragOverColumnArray.forEach(element => {
        element.classList.remove('onDragOverColumn');
    });
}
</script>

<style>
.dragging {
    opacity: 50%;
}

.onDragOverAsPrev {
    border-top: var(--color-primary) solid !important;
}

.onDragOverAsNext {
    border-bottom: var(--color-primary) solid !important;
}
</style>