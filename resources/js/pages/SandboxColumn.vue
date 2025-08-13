<script setup lang="ts">
import BadgeStatus from "@/components/entities/tasks/BadgeStatus.vue";
import { Workflow } from "@/types";
import { ref } from "vue";

interface Props {
    workflow: Workflow
}

defineProps<Props>()

const isDragoverOnColumn = ref<boolean>(false);

const onDragOverColumnHandler = (event: DragEvent) => {
    event.preventDefault();
    isDragoverOnColumn.value = true;
}
const onDragLeaveColumnHandler = (event: DragEvent) => {
    event.preventDefault();
    isDragoverOnColumn.value = false;
}

</script>

<template>
    <div class="flex flex-col h-full">
        <div class="flex flex-row gap-[.4em] py-[.8em]">
            <BadgeStatus :status_category="workflow.category" :status_name="workflow.name" />
            <div class="place-items-center grid border rounded-full h-[1.2em] aspect-square">
                <p class="leading-none"> {{ workflow.tasks?.length }} </p>
            </div>
        </div>
        <div class="flex flex-col flex-1 border border-dashed w-[370px] overflow-scroll">
            <slot />
            <div :key="workflow.id" :class="{ 'onDragOverColumn': isDragoverOnColumn }" class="flex-1 bg-amber-700/5" @dragover="(e) => onDragOverColumnHandler(e)" @dragleave="(e) => onDragLeaveColumnHandler(e)"></div>

        </div>
    </div>
</template>

<style>
.onDragOverColumn {
    border-top: var(--color-primary) solid !important;
}
</style>