<template>
    <div class="table border-t w-full">
        <div class="table-header-group">
            <div class="table-row divide-x">
                <div class="table-cell opacity-40 px-[.8em] py-[.2em] border-b w-[8em]">Key</div>
                <div class="table-cell opacity-40 px-[.8em] py-[.2em] border-b">Summary</div>
                <div class="table-cell opacity-40 px-[.8em] py-[.2em] border-b w-[4em] text-right">Point</div>
                <div class="table-cell opacity-40 px-[.8em] py-[.2em] border-b w-[10em]">Status</div>
            </div>
        </div>
        <div class="table-row-group">
            <QueseraTaskListItem v-for="(task, index) in project.tasks" :task="task" :workflows="project.workflows" :key="index" />
        </div>
    </div>
    <div class="place-items-center grid hover:bg-white/10 border-b h-[1.8em] text-center animate-pulse">
        <p class="opacity-40 text-[.8em]">What's need to be done?</p>
    </div>
</template>

<script setup lang="ts">
import { Project } from '@/types';
import QueseraTaskListItem from './QueseraTaskListItem.vue';

interface Props {
    project: Project
}

defineProps<Props>()

</script>