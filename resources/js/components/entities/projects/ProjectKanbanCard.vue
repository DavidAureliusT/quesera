<template>
    <div :id="task.key + '-card'" draggable="true" @dragstart="onDragStartHandler" @dragend="onDragEndHandler" :class="{
        'opacity-50': isDragging,
        'border-white/30 bg-white/5 overflow-clip border text-white/80': 'To do' == task.status_category,
        'border-process/30 bg-process/5 overflow-clip border text-process/80': 'In Progress' == task.status_category,
        'border-primary/30 bg-primary/5 overflow-clip border text-primary/80': 'Done' == task.status_category,
    }" class="bg-[var(--primary-foreground)] rounded-2xl transition-all cursor-pointer">
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
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Task } from '@/types';

const props = defineProps<{ task: Task }>()

const isDragging = ref<boolean>(false)

const onDragStartHandler = (event: DragEvent) => {
    isDragging.value = true;
    const draggingCard = document.getElementById(props.task.key + '-card');
    draggingCard?.classList.add('dragging');

    if (event.target instanceof HTMLElement && event.dataTransfer) {
        event.dataTransfer.setData("task_key", props.task.key);
        event.dataTransfer.setData("status_id", props.task.status_id);
    }
}
const onDragEndHandler = () => {
    isDragging.value = false;
    const draggingCard = document.getElementById(props.task.key + '-card');
    draggingCard?.classList.remove('dragging');
}
</script>

<style>
.dragging {
    opacity: 50%;
}
</style>