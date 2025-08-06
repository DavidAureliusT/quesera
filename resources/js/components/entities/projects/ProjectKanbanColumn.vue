<template>
    <div class="">
        <BadgeStatus :status_category="workflow.category" :status_name="workflow.name" />
    </div>
    <div :id="workflow.id + '-column'" @drop="onDropHandler" @dragover="onDragoverHandler" :class="classes">
        <ProjectKanbanCard v-for="(task, index) in project.tasks?.filter((task) => task.status_name == workflow.name)" :key="index" :task="task" />
    </div>
</template>

<script setup lang="ts">
import { reactive, Reactive, onMounted } from "vue";
import { useForm } from '@inertiajs/vue3'
import { Project, Workflow } from '@/types';
import BadgeStatus from '@/components/entities/tasks/BadgeStatus.vue';
import { useToast } from '@/components/ui/toast/use-toast';
import ProjectKanbanCard from "@/components/entities/projects/ProjectKanbanCard.vue";

const { toast } = useToast();

const props = defineProps<{ project: Project, workflow: Workflow }>()

const form = useForm({
    status_id: props.workflow.id,
})

const container: Reactive<{ element: HTMLElement | null }> = reactive({ element: null })

onMounted(() => {
    container.element = document.getElementById(props.workflow.id + '-column');
});

const classes = "flex flex-col gap-2 bg-white/5 mt-[.4em] p-[.4em] border border-dashed rounded-[1.2em] h-[calc(100vh-(11*1.8em))] overflow-y-scroll";

const onDropHandler = (event: DragEvent) => {
    event.preventDefault();
    if (event.target instanceof HTMLElement && event.dataTransfer) {
        const _task_key = event.dataTransfer.getData("task_key");
        const _status_id = event.dataTransfer.getData("status_id");
        if (props.workflow.id != _status_id) submitUpdateTaskStatusId(_task_key);
    }
}

const onDragoverHandler = (event: DragEvent) => {
    event.preventDefault();

    if (event.target instanceof HTMLElement && event.dataTransfer) {
        const _task_key = event.dataTransfer.getData("task_key");
        const darggingCard = document.getElementById(_task_key + '-card');
        container.element?.appendChild(darggingCard as HTMLElement);
    }
}

const submitUpdateTaskStatusId = (task_key: string) => {
    form.put(route('projects.tasks.update', { project_key: form.status_id, task_key: task_key }), {
        onSuccess: () => {
            toast({
                title: "Task Updated",
                description: JSON.stringify(form.data()),
            });
            const kanbanColumn = document.getElementById(form.status_id + '-column');

            kanbanColumn?.removeChild(kanbanColumn.lastChild!);
        }
    })
}

</script>