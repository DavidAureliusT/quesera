<script setup lang="ts">
import { Project } from '@/types';
// import ProjectKanbanCard from './ProjectKanbanCard.vue';
import ProjectKanbanColumn from './ProjectKanbanColumn.vue';

defineProps<{ project: Project, bytes: string }>()

</script>

<template>
    <div class="flex flex-nowrap gap-[.8em] overflow-x-scroll">
        <ProjectKanbanColumn v-for="(workflow) in project?.workflows" :key="workflow.id" :project_key="project.key" :tasks="project.tasks?.filter((task) => task.status_name == workflow.name)" :workflow="workflow" :bytes="bytes" />
    </div>
</template>