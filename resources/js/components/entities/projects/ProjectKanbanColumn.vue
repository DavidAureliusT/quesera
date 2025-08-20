<template>
    <div class="flex flex-col h-[calc(100vh-(8*1.8em))]">
        <!-- Head -->
        <div class="flex-none">
            <div class="flex flex-row gap-[.4em] py-[.8em]">
                <BadgeStatus :status_category="workflow.category" :status_name="workflow.name" />
                <div class="place-items-center grid border rounded-full h-[1.2em] aspect-square">
                    <p class="leading-none"> {{ workflow.tasks?.length }} </p>
                </div>
            </div>
        </div>
        <!-- Body -->
        <div class="flex flex-col flex-1 bg-black p-[.2em] border border-dashed rounded-2xl w-[370px] overflow-scroll">
            <slot />
            <CardCreateTask :project_key="project_key" :status_id="workflow.id.toString()" />
            <div :key="workflow.id" :class="{ 'onDragOverColumn': isDragoverOnColumn }" class="flex-1 bg-amber-700/5" @dragover="(e) => onDragOverColumnHandler(e)" @dragleave="(e) => onDragLeaveColumnHandler(e)"></div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { Workflow } from "@/types";
import BadgeStatus from "@/components/entities/tasks/BadgeStatus.vue";
import CardCreateTask from "@/actions/CardCreateTask.vue";

import { useToast } from '@/components/ui/toast/use-toast';
const { toast } = useToast();

interface Props {
    project_key: string,
    workflow: Workflow
}

const props = defineProps<Props>()

const form = useForm({
    status_id: props.workflow.id,
})

const isDragoverOnColumn = ref<boolean>(false);

const onDragOverColumnHandler = (event: DragEvent) => {
    event.preventDefault();
    isDragoverOnColumn.value = true;
}
const onDragLeaveColumnHandler = (event: DragEvent) => {
    event.preventDefault();
    isDragoverOnColumn.value = false;
}

const submitUpdateTaskStatusId = (task_key: string) => {
    form.put(route('projects.tasks.update', { project_key: props.project_key, task_key: task_key }), {
        onSuccess: () => {
            toast({
                title: "Task Updated",
                description: JSON.stringify(form.data()),
            });
        }
    })
}

</script>



<style>
.onDragOverColumn {
    border-top: var(--color-primary) solid !important;
}
</style>