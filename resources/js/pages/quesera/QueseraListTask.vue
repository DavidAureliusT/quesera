<script setup lang="ts">
import { Project, Task } from '@/types';
import { reactive, Reactive, watchEffect } from "vue";

import QueseraListHeaderTask from './QueseraListHeaderTask.vue';
import QueseraListItemTask from './QueseraListItemTask.vue';
import QueseraListCreateTask from './QueseraListCreateTask.vue';

interface Props {
    project: Project
}

const props = defineProps<Props>()

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

            // Sort by point
            if (filters.sorting.point !== 'default') {
                if (a.point !== b.point) {
                    return filters.sorting.point === 'ascending' ? a.point - b.point : b.point - a.point;
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
    <div class="m-[1em] border rounded-lg overflow-clip">
        <QueseraListHeaderTask :sorting="filters.sorting" @update-filter="handleUpdateSorting" />
        <div class="border-t h-[calc(100vh-18em-1.8em)] overflow-y-auto">
            <QueseraListItemTask v-for="task in filteredTasks.data" :task="task" :workflows="project.workflows" :key="task.key" />
        </div>
        <QueseraListCreateTask :project_key="project.key" />
    </div>
</template>