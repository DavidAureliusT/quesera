<script setup lang="ts">
import { ref, onMounted, watch } from "vue";
import { Task, Workflow } from '@/types';
import { useToast } from "@/components/ui/toast";
import BadgeStatus from "../tasks/BadgeStatus.vue";
import ProjectKanbanCard from "./ProjectKanbanCard.vue";
import ProjectKanbanDropZoneIndicator from "./ProjectKanbanDropZoneIndicator.vue";

interface Props {
    workflow: Workflow,
    showOverlay: boolean,
}
interface Emits {
    'toggle-show-overlay': [],
}
const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const { toast } = useToast();

const orderedTasks = ref<Task[]>([])

function buildOrderedTasks(tasks: Task[]): Task[] {
    // find the head
    const head = tasks.find(t => t.is_head)
    if (!head) return []

    const ordered: Task[] = []

    function walkChain(current: Task | undefined) {
        if (!current) return

        ordered.push(current)

        if (current.next_id != null) {
            const next = tasks.find(t => t.id == String(current.next_id))
            walkChain(next)
        }
    }

    walkChain(head)
    return ordered
}

// recompute when mounted
onMounted(() => {
    if (props.workflow.tasks != undefined) orderedTasks.value = buildOrderedTasks(props.workflow.tasks)
})

// recompute whenever tasks update
watch(
    () => props.workflow.tasks,
    (newTasks) => {
        if (newTasks != undefined) orderedTasks.value = buildOrderedTasks(newTasks)
    },
    { deep: true }
)

const showOnToast = (message?: string) => {
    toast({
        title: 'TaskCard Dropped',
        description: message,
    });
}

const toggleShowOverlay = () => {
    emit('toggle-show-overlay');
}

const handleCardOnDropOverlay = (e: DragEvent) => {
    e.preventDefault()
    if (e.currentTarget instanceof HTMLElement && e.dataTransfer instanceof DataTransfer) {
        const elementId = e.currentTarget.id;
        const cardId = e.dataTransfer.getData("text/plain");
        showOnToast(cardId + ' on ' + elementId);
    }
}

const handleCardOnDragEnterOverlay = (e: DragEvent) => { e.preventDefault() }

const handleCardOnDragOverHeadOverlay = (e: DragEvent, workflow_id: string) => {
    e.preventDefault();
    const indicatorElement = document.getElementById(workflow_id + '-head-indicator');
    if (indicatorElement instanceof Element) indicatorElement.classList.add('active-indicator');
}
const handleCardOnDragOverNextOverlay = (e: DragEvent, workflow_id: string, task_key: string) => {
    e.preventDefault();
    const indicatorElement = document.getElementById(workflow_id + '-next-' + task_key + '-indicator');
    if (indicatorElement instanceof Element) indicatorElement.classList.add('active-indicator');
}
const handleCardOnDragLeaveOverlay = (e: DragEvent) => {
    e.preventDefault();
    clearAllIndicator();
}
const clearAllIndicator = () => {
    const indicatorElement = document.getElementsByClassName('active-indicator');
    const indicatorElementArray = Array.from(indicatorElement);
    indicatorElementArray.forEach(element => {
        element.classList.remove('active-indicator');
    });
}
</script>

<template>
    <div class="flex flex-col h-full">
        <!-- WorkflowStatusBadge.vue -->
        <div class="flex items-center gap-2 px-2 h-[3em]">
            <BadgeStatus :status_category="workflow.category" :status_name="workflow.name" /> {{ orderedTasks.length == 0 }}
        </div>

        <!-- KanbanColumn.vue -->
        <div class="relative flex flex-col gap-[.3em] p-[.4em] border w-[320px] h-full">

            <!-- Head Indicator -->
            <ProjectKanbanDropZoneIndicator :indicator-name="workflow.id + '-head-indicator'" />

            <!-- TaskCard.vue Chain  -->
            <!-- <pre>{{ orderedTasks }}</pre> -->
            <ProjectKanbanCard v-for="task in orderedTasks" :key="task.key" :task="task" v-on:clear-all-indicator="clearAllIndicator" v-on:toggle-show-overlay="toggleShowOverlay" />
            <!-- Overlay -->
            <div class="absolute inset-0" :class="{ '-z-10': !showOverlay, 'z-20': showOverlay }">
                <div class="flex flex-col h-full">
                    <div :id="workflow.name + '-head-dropzone'" :class="orderedTasks.length == 0 ? 'flex-1' : 'h-[calc(60px+1.0em)]'" class="bg-primary/5 border-y" @drop="(e) => handleCardOnDropOverlay(e)" @dragenter="(e) => handleCardOnDragEnterOverlay(e)" @dragover="(e) => handleCardOnDragOverHeadOverlay(e, workflow.id)" @dragleave="(e) => handleCardOnDragLeaveOverlay(e)"></div>
                    <div v-for="(task, index) in orderedTasks" :key="index" :id="workflow.name + '-next-' + task.key + '-dropzone'" class="p-[1.8em] border-y font-black" :class="{
                        'bg-red-500/5 h-[calc(130px+.8em)] flex-none': index < orderedTasks.length - 1,
                        'flex-1 bg-blue-900/50 ': index == orderedTasks.length - 1,
                    }" @drop="(e) => handleCardOnDropOverlay(e)" @dragenter="(e) => handleCardOnDragEnterOverlay(e)" @dragover="(e) => handleCardOnDragOverNextOverlay(e, workflow.id, task.key)" @dragleave="(e) => handleCardOnDragLeaveOverlay(e)">
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<style>
.active-indicator {
    background-color: var(--color-primary);
}
</style>