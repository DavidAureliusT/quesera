<template>
    <div class="table border-t w-full">
        <div class="table-header-group">
            <div class="table-row bg-black divide-x">
                <div class="table-cell opacity-40 px-[.8em] py-[.2em] border-b w-[8em]">Key</div>
                <div class="table-cell opacity-40 px-[.8em] py-[.2em] border-b">Summary</div>
                <div class="table-cell opacity-40 px-[.8em] py-[.2em] border-b w-[4em] text-right">Point</div>
                <div class="table-cell opacity-40 px-[.8em] py-[.2em] border-b w-[10em]">Status</div>
            </div>
        </div>
        <div class="table-row-group">
            <QueseraTaskListItem v-for="(task, index) in project.tasks" :task="task" :workflows="project.workflows" :key="index" />
            <QueseraTaskListCreate :project_key="project.key" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { Project } from '@/types';
import QueseraTaskListItem from './QueseraTaskListItem.vue';
import QueseraTaskListCreate from './QueseraTaskListCreate.vue';

interface Props {
    project: Project
}

defineProps<Props>()

</script>