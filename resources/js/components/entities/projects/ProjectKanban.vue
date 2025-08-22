<script setup lang="ts">
import { ref } from "vue";
import { Project } from '@/types';
import ProjectKanbanColumn from "./ProjectKanbanColumn.vue";

interface Props {
    project: Project
}

defineProps<Props>();

const showOverlay = ref(false);

const toggleShowOverlay = () => {
    showOverlay.value = !showOverlay.value;
}

</script>

<template>
    <div class="flex flex-nowrap bg-neutral-900/50 h-[calc(100vh-(8*1.8em))] overflow-scroll">
        <ProjectKanbanColumn v-for="workflow in project.workflows" :key="workflow.id" :workflow="workflow" :show-overlay="showOverlay" v-on:toggle-show-overlay="toggleShowOverlay" />
    </div>
</template>