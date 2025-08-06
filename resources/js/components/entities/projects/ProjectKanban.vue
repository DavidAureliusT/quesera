<script setup lang="ts">
import { Project } from '@/types';
// import ProjectKanbanCard from './ProjectKanbanCard.vue';
import ProjectKanbanColumn from './ProjectKanbanColumn.vue';

defineProps<{ project: Project }>()

</script>

<template>
    <div class="flex gap-[.8em]">
        <div v-for="(workflow) in project?.workflows" :key="workflow.id" class="flex-1">
            <ProjectKanbanColumn :project="project" :workflow="workflow" />
        </div>
    </div>
</template>