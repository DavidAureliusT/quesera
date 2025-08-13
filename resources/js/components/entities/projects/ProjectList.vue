<script setup lang="ts">
import { reactive, Reactive, watchEffect } from "vue";
import { Project, Task } from '@/types';
import { ChevronUp, ChevronDown, ChevronsUpDown } from "lucide-vue-next";
// import RowCreateTask from '@/actions/RowCreateTask.vue';
import AutoSubmitInput from "@/actions/AutoSubmitInput.vue";
import BadgeStatus from "@/components/entities/tasks/BadgeStatus.vue";
import { DropdownMenuRadioItem } from '@/components/ui/dropdown-menu'

import AutoSubmitDropdownMenu from "@/actions/AutoSubmitDropdownMenu.vue";

const props = defineProps<{ project: Project }>()

const filters = reactive({
    sorting: {
        key: 'default',
        summary: 'default',
        point: 'default',
        status_id: 'default',
    }
})

const filteredTasks: Reactive<{ data: Task[] }> = reactive({ data: [] })

watchEffect(() => {
    filteredTasks.data = [...(props.project.tasks || [])]
        .sort((a: Task, b: Task) => {
            // Sort by key
            if (filters.sorting.key !== 'default') {
                const keyA = parseInt(a.key.split('-')[1]);
                const keyB = parseInt(b.key.split('-')[1]);
                if (keyA !== keyB) {
                    return filters.sorting.key === 'ascending' ? keyA - keyB : keyB - keyA;
                }
            }

            // Sort by summary (alphabetically)
            if (filters.sorting.summary !== 'default') {
                const comparison = a.summary.localeCompare(b.summary);
                if (comparison !== 0) {
                    return filters.sorting.summary === 'ascending' ? comparison : -comparison;
                }
            }

            // Sort by status_id
            if (filters.sorting.status_id !== 'default') {
                const statusA = parseInt(a.status_id);
                const statusB = parseInt(b.status_id);
                if (statusA !== statusB) {
                    return filters.sorting.status_id === 'ascending' ? statusA - statusB : statusB - statusA;
                }
            }

            // Sort by point
            if (filters.sorting.point !== 'default') {
                if (a.point !== b.point) {
                    return filters.sorting.point === 'ascending' ? a.point - b.point : b.point - a.point;
                }
            }

            return 0; // Keep original order if equal or default
        })
})

function handleUpdateSorting(column: string, order: string) {
    if (column == 'key') filters.sorting.key = order;
    if (column == 'summary') filters.sorting.summary = order;
    if (column == 'point') filters.sorting.point = order;
    if (column == 'status_id') filters.sorting.status_id = order;
}

</script>

<template>
    <div class="flex flex-col mt-[1.8em] border-y">
        <div class="flex flex-row bg-sidebar divide-x">
            <div class="flex flex-none justify-between items-center px-[.8em] border-b w-[8em] h-[1.8em] align-middle">
                <p class="text-white/50">Key</p>
                <ChevronsUpDown @click="handleUpdateSorting('key', 'ascending')" v-if="filters.sorting.key == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
                <ChevronUp @click="handleUpdateSorting('key', 'descending')" v-if="filters.sorting.key == 'ascending'" :size="16" class="opacity-80 hover:opacity-100" />
                <ChevronDown @click="handleUpdateSorting('key', 'default')" v-if="filters.sorting.key == 'descending'" :size="16" class="opacity-80 hover:opacity-100" />
            </div>
            <div class="flex flex-1 justify-between items-center px-[.8em] border-b h-[1.8em] align-middle">
                <p class="text-white/50">Summary</p>
                <ChevronsUpDown @click="handleUpdateSorting('summary', 'ascending')" v-if="filters.sorting.summary == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
                <ChevronUp @click="handleUpdateSorting('summary', 'descending')" v-if="filters.sorting.summary == 'ascending'" :size="16" class="opacity-80 hover:opacity-100" />
                <ChevronDown @click="handleUpdateSorting('summary', 'default')" v-if="filters.sorting.summary == 'descending'" :size="16" class="opacity-80 hover:opacity-100" />
            </div>
            <div class="flex flex-none justify-between items-center px-[.8em] border-b w-[6em] h-[1.8em] text-right">
                <p class="text-white/50">Point</p>
                <ChevronsUpDown @click="handleUpdateSorting('point', 'ascending')" v-if="filters.sorting.point == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
                <ChevronUp @click="handleUpdateSorting('point', 'descending')" v-if="filters.sorting.point == 'ascending'" :size="16" class="opacity-80 hover:opacity-100" />
                <ChevronDown @click="handleUpdateSorting('point', 'default')" v-if="filters.sorting.point == 'descending'" :size="16" class="opacity-80 hover:opacity-100" />
            </div>
            <div class="flex flex-none justify-between items-center px-[.8em] border-b w-[8em] h-[1.8em]">
                <p class="text-white/50">Status</p>
                <ChevronsUpDown @click="handleUpdateSorting('status_id', 'ascending')" v-if="filters.sorting.status_id == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
                <ChevronUp @click="handleUpdateSorting('status_id', 'descending')" v-if="filters.sorting.status_id == 'ascending'" :size="16" class="opacity-80 hover:opacity-100" />
                <ChevronDown @click="handleUpdateSorting('status_id', 'default')" v-if="filters.sorting.status_id == 'descending'" :size="16" class="opacity-80 hover:opacity-100" />
            </div>
        </div>
        <div class="h-[calc(100vh-(11*1.8em))] overflow-y-scroll">
            <div v-for="(task) in filteredTasks.data" :key="task.key" :task="task" class="flex flex-row hover:bg-white/10 divide-x">
                <div class="px-[.8em] border-b w-[8em] h-[1.8em] align-middle">
                    <p>{{ task.key }}</p>
                </div>
                <div class="flex-1 px-[.8em] border-b h-[1.8em] align-middle">
                    <AutoSubmitInput type="text" method="put" :url="route('projects.tasks.update', { project_key: task.key.split('-')[0], task_key: task.key })" attribute-name="summary" :input-value="task.summary" title="Task Updated" />
                </div>
                <div class="px-[.8em] border-b w-[6em] h-[1.8em] text-center align-middle">
                    <AutoSubmitInput type="number" method="put" :url="route('projects.tasks.update', { project_key: task.key.split('-')[0], task_key: task.key })" attribute-name="point" :input-value="task.point" title="Task Updated" />
                </div>
                <div class="items-center place-items-center grid px-[.8em] border-b w-[8em] h-[1.8em]">
                    <AutoSubmitDropdownMenu type="number" method="put" :url="route('projects.tasks.update', { project_key: task.key.split('-')[0], task_key: task.key })" attribute-name="status_id" :input-value="task.status_id.toString()" title="Task Updated">
                        <template #trigger>
                            <BadgeStatus :status_category="task.status_category" :status_name="task.status_name" />
                        </template>
                        <template #dropdown-menu-radio-items>
                            <DropdownMenuRadioItem v-for="(workflow, index) in project.workflows" :key="index" :value="workflow.id.toString()">
                                <div class="px-[.4em] rounded w-fit font-bold text-[1.0em] uppercase leading-[1em]">
                                    <p>{{ workflow.name }}</p>
                                </div>
                            </DropdownMenuRadioItem>
                        </template>
                    </AutoSubmitDropdownMenu>
                </div>
            </div>
        </div>
        <div class="flex flex-row hover:bg-white/10">
            <div class="border-t w-[8em]" />
            <div class="flex-1 px-[.8em] border-t h-[1.8em] align-middle">
                <AutoSubmitInput type="text" method="post" :url="route('projects.tasks.store', { project_key: project.key })" attribute-name="summary" title="New Task" placeholder="What's need to be done?" :use-reset="true" />
            </div>
            <div class="border-t w-[6em]" />
            <div class="border-t w-[8em]" />
        </div>
    </div>
</template>