<script setup lang="ts">
import { inject } from 'vue';
import { Project } from '@/types';
import TaskListItem from "@/components/entities/tasks/ListItem.vue";

const project = inject<Project>('shared_project');

</script>

<template>
    <div class="flex flex-col w-[50vw]">
        <TaskListItem v-for="(task, index) in project!.tasks" :key="index" :task="task" />
    </div>
</template>