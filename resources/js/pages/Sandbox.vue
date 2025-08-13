<script setup lang="ts">
import { Project } from '@/types';
import SandboxCard from './SandboxCard.vue';
import SandboxColumn from './SandboxColumn.vue';

interface Props {
    project: Project
}

defineProps<Props>()


</script>

<template>
    <div class="flex flex-nowrap bg-neutral-950 w-[100vw] h-[100vh] overflow-scroll">
        <SandboxColumn v-for="workflow in project.workflows" :key="workflow.id" :workflow="workflow">
            <SandboxCard v-for="task in workflow.tasks" :key="task.key" :task="task" />
        </SandboxColumn>
    </div>
</template>