<script setup lang="ts">
import { Project } from '@/types';
import TaskListItem from "@/components/entities/tasks/ListItem.vue";
import RowCreateTask from '@/actions/RowCreateTask.vue';

defineProps<{ project?: Project }>()

</script>

<template>
    <div class="flex flex-col w-full">
        <div class="flex">

        </div>
        <TaskListItem v-for="(task, index) in project!.tasks" :key="index" :task="task" />
        <RowCreateTask :project_key="project!.key" />
    </div>
</template>