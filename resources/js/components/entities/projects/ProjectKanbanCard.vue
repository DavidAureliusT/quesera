<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import { Task } from '@/types';
import ProjectKanbanDropZoneIndicator from "./ProjectKanbanDropZoneIndicator.vue";
import BadgeStatus from "../tasks/BadgeStatus.vue";

interface Props {
    task: Task
}
interface Emits {
    'toggle-show-overlay': [],
    'clear-all-indicator': [],
}
defineProps<Props>()
const emit = defineEmits<Emits>()

const page = usePage()

const handleCardOnDragStart = (e: DragEvent) => {
    emit('toggle-show-overlay');
    if (e.target instanceof HTMLElement && e.dataTransfer instanceof DataTransfer) {
        e.dataTransfer.clearData();
        e.dataTransfer.setData("text/plain", e.target.id)
    }
}

const handleCardOnDragEnd = (e: DragEvent) => {
    e.preventDefault();
    emit('toggle-show-overlay');
    emit('clear-all-indicator');
}

</script>

<template>
    <div :id="task.key" draggable="true" @dragstart="(e) => handleCardOnDragStart(e)" @dragend="handleCardOnDragEnd">
        <div class="bg-black border rounded-[5pt] h-[130px] overflow-clip">
            <div class="flex flex-col justify-between p-[1.2em] h-full">
                <!-- WorkflowStatusBadge.vue -->
                <BadgeStatus :status_category="task.status_category" :status_name="task.status_name" />
                <div class="flex flex-col gap-[.6em]">
                    <p class="leading-[1.2em]">{{ task.key }} - {{ task.summary }}</p>
                    <div class="flex justify-between">
                        <div class="flex flex-row items-start gap-[.2em] text-neutral-300">
                            <p class="text-[.8em] leading-[.8em]">{{ String(task.point).padStart(2, '0') }}</p>
                            <p class="text-[.6em] leading-[.8em]">Point(s)</p>
                        </div>
                        <div class="flex items-center gap-[.4em] text-[.6em]">
                            <div class="place-items-center grid bg-foreground rounded-full w-[1.8em] aspect-square font-medium text-black uppercase">{{ page.props.auth.user.name.slice(0, 2) }}</div>
                            <div class="">{{ page.props.auth.user.name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Task Indicator -->
        <ProjectKanbanDropZoneIndicator :indicator-name="task.status_id + '-next-' + task.key + '-indicator'" />

    </div>
</template>