<script setup lang="ts">
interface Props {
    overlayName: string,
    variant: 'head' | 'next_of' | 'tail',
    workflow_id: string,
    task_key?: string,
}
interface Emits {
    'drop': [event: DragEvent],
    'dargenter': [event: DragEvent],
    'dragover': [event: DragEvent, workflow_id: string],
    'dragleave': [event: DragEvent],
}
defineProps<Props>()
const emit = defineEmits<Emits>()

</script>

<template>
    <div v-if="variant == 'head'" :id="overlayName" :class="task_key == undefined ? 'flex-1' : 'h-[calc(60px+1.0em)]'" class="bg-primary/5 border-y" @drop="(e) => emit('drop', { e })" @dragenter="(e) => handleCardOnDragEnterOverlay(e)" @dragover="(e) => handleCardOnDragOverHeadOverlay(e, workflow_id)" @dragleave="(e) => handleCardOnDragLeaveOverlay(e)"></div>

    <div :id="overlayName" class="p-[1.8em] border-y font-black" :class="{
        'bg-red-500/5 h-[calc(130px+.8em)] flex-none': index < orderedTasks.length - 1,
        'flex-1 bg-blue-900/50 ': index == orderedTasks.length - 1,
    }" @drop="(e) => handleCardOnDropOverlay(e)" @dragenter="(e) => handleCardOnDragEnterOverlay(e)" @dragover="(e) => handleCardOnDragOverNextOverlay(e, workflow.id, task.key)" @dragleave="(e) => handleCardOnDragLeaveOverlay(e)">
    </div>
</template>