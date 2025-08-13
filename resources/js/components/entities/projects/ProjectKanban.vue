<script setup lang="ts">
import { Project } from '@/types';
import ProjectKanbanCard from './ProjectKanbanCard.vue';
import ProjectKanbanColumn from './ProjectKanbanColumn.vue';

defineProps<{ project: Project, bytes: string }>()

</script>

<template>
    <div class="flex flex-nowrap gap-[.8em] bg-amber-950 p-[.8em] overflow-scroll">
        <ProjectKanbanColumn v-for="workflow in project.workflows" :key="workflow.id" :workflow="workflow" :project_key="project.key">
            <ProjectKanbanCard v-for="task in workflow.tasks" :key="task.key" :task="task" />
        </ProjectKanbanColumn>
    </div>
</template>