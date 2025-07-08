<template>
    <div class="place-items-center grid">
        <div class="border rounded-lg w-[70em] overflow-clip">
            <QueseraListHeaderTask />
            <div class="border-t h-[calc(100vh-18em)] overflow-y-auto">
                <QueseraListItemTask v-for="(task, index) in project.tasks" :task="task" :workflows="project.workflows" :key="index" />
            </div>
            <QueseraListCreateTask :project_key="project.key" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { Project } from '@/types';
import QueseraListItemTask from './QueseraListItemTask.vue';
import QueseraListCreateTask from './QueseraListCreateTask.vue';
import QueseraListHeaderTask from './QueseraListHeaderTask.vue';

interface Props {
    project: Project
}

defineProps<Props>()

</script>