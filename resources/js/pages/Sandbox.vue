<script setup lang="ts">
import { Project } from '@/types';
import SandboxCard from './SandboxCard.vue';

interface Props {
    project: Project
}

defineProps<Props>()



</script>

<template>
    <div class="flex flex-nowrap bg-neutral-950 w-[100vw] h-[100vh] overflow-scroll">
        <div v-for="workflow in project.workflows" :key="workflow.id">
            <div class="flex flex-col h-full">
                <!-- Workflow Id -->
                <pre>{{ workflow.id }} - {{ workflow.category }} - {{ workflow.name }}</pre>

                <!-- Kanban Column (start) -->
                <div class="flex-1 mt-4 border border-dashed w-[370px]">
                    <!-- Task Card -->
                    <SandboxCard v-for="task in workflow.tasks" :key="task.key" :task="task" />

                </div>
                <!-- Kanban Column (end) -->
            </div>
        </div>
    </div>
</template>

<style></style>