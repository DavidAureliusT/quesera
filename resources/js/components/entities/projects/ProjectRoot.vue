<script setup lang="ts">
import { inject } from 'vue';
import { Project } from '@/types';
import ProjectBarTop from './ProjectBarTop.vue';
import ProjectHeader from './ProjectHeader.vue';

const project = inject<Project>('shared_project');


</script>

<template>
    <div class="flex flex-col">
        <ProjectBarTop :project_type="project!.type" />
        <ProjectHeader class="h-[calc(3*1.8em)]" :project="project!" />
    </div>
</template>