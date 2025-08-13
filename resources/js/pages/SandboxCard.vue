<script setup lang="ts">
import { ref } from "vue";
import { Task } from '@/types';

interface Props { task: Task }

defineProps<Props>()

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
}

</script>

<template>
    <div draggable="true" @dragstart="(e) => onDragStartHandler(e, task)" @dragend="(e) => onDragEndHandler(e)" class="relative p-[.8em]">
        <div class="bg-black p-[.4em] border rounded-2xl overflow-clip">
            <pre>{{ task }}</pre>

            <div :id="task.key + '-card'" :class="{ 'onDragOverAsPrev': isDragoverOnPrev, 'onDragOverAsNext': isDragoverOnNext }" class="absolute inset-0 flex flex-col bg-black/50 border-y border-transparent text-foreground" @dragleave="onDragLeaveHandler">
                <div class="flex-1 place-items-center grid" @dragover="(e) => onDragOverHandler(e, task, 'previous')">
                    <pre>Prev</pre>
                </div>
                <div class="flex-1 place-items-center grid" @dragover="(e) => onDragOverHandler(e, task, 'next')">
                    <pre>Next</pre>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.onDragOverAsPrev {
    border-top: var(--color-primary) solid !important;
}

.onDragOverAsNext {
    border-bottom: var(--color-primary) solid !important;
}
</style>