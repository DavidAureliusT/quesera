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
        status: 'default',
    }
})

const filteredTasks: Reactive<{ data: Task[] }> = reactive({ data: props.project.tasks! })

watchEffect(() => {
    filteredTasks.data = props.project.tasks!
        .sort((a: Task, b: Task) => {
            const keyA = a.key.split('-')[1];
            const keyB = b.key.split('-')[1];
            if (filters.sorting.key == 'ascending' || filters.sorting.key == 'default') {
                return parseInt(keyA) < parseInt(keyB) ? -1 : 1;
            } else {
                return parseInt(keyA) > parseInt(keyB) ? -1 : 1;
            }
        })
        .sort((a: Task, b: Task) => {
            const pointA = a.point;
            const pointB = b.point;
            if (filters.sorting.point == 'ascending' || filters.sorting.point == 'default') {
                return pointA < pointB ? -1 : 1;
            } else {
                return pointA > pointB ? -1 : 1;
            }
        });
})
function handleUpdateSorting(column: string, order: string) {
    if (column == 'key') filters.sorting.key = order;
    if (column == 'summary') filters.sorting.summary = order;
    if (column == 'point') filters.sorting.point = order;
    if (column == 'status') filters.sorting.key = order;
}

</script>

<template>
    <div class="m-[1em] border rounded-lg overflow-clip">
        <QueseraListHeaderTask :sorting="filters.sorting" @update-filter="handleUpdateSorting" />
        <div class="border-t h-[calc(100vh-18em)] overflow-y-auto">
            <!-- <pre>{{ filters }}</pre>
            <pre>{{filteredTasks.data.map((v) => v.key)}}</pre> -->
            <QueseraListItemTask v-for="task in filteredTasks.data" :task="task" :workflows="project.workflows" :key="task.key" />
        </div>
        <QueseraListCreateTask :project_key="project.key" />
    </div>
</template>