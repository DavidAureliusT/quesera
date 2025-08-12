<script setup lang="ts">
import { ref, reactive, Reactive, onMounted, onUpdated } from "vue";
import { useForm } from '@inertiajs/vue3'
import { Task, Workflow } from '@/types';
import BadgeStatus from '@/components/entities/tasks/BadgeStatus.vue';
import { useToast } from '@/components/ui/toast/use-toast';
import ProjectKanbanCard from "@/components/entities/projects/ProjectKanbanCard.vue";
import CardCreateTask from "@/actions/CardCreateTask.vue";

const { toast } = useToast();

const props = defineProps<{ project_key: string, tasks: Task[] | undefined, workflow: Workflow, bytes: string }>()

const reactiveTasks = ref<Task[]>(props.tasks || []);

const form = useForm({
    status_id: props.workflow.id,
})

const container: Reactive<{ element: HTMLElement | null }> = reactive({ element: null })

onMounted(() => {
    container.element = document.getElementById(props.workflow.id + '-column');
});

onUpdated(() => {
    // console.log({ [props.workflow.id + '-col']: JSON.stringify(props.tasks) })
});

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
    form.put(route('projects.tasks.update', { project_key: props.project_key, task_key: task_key }), {
        onSuccess: () => {
            toast({
                title: "Task Updated",
                description: JSON.stringify(form.data()),
            });
            const taskEl = document.getElementById(task_key + '-card');
            if (taskEl) taskEl.remove();

            reactiveTasks.value = [...(props.tasks || [])];
        }
    })
}

const classes = "flex-1 flex flex-col gap-2 bg-white/5 mt-[.4em] p-[.4em] border border-dashed rounded-[1.2em] h-[calc(100vh-(11*1.8em))] overflow-y-scroll";

</script>

<template>
    <div class="flex-none w-[20em]">
        <div class="flex justify-between">
            <BadgeStatus :status_category="workflow.category" :status_name="workflow.name" />
            <p class="text-white">bytes: {{ bytes }}</p>
        </div>
        <div :id="workflow.id + '-column'" @drop="onDropHandler" @dragover="onDragoverHandler" :class="classes">
            <ProjectKanbanCard v-for="(task, index) in reactiveTasks" :key="index" :task="task" />
            <CardCreateTask :project_key="project_key" :status_id="workflow.id.toString()" />
        </div>
    </div>
</template>