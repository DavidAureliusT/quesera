<script setup lang="ts">
import { ref, inject } from 'vue';
import { Project } from '@/types';
import QueseraListTask from '@/components/_quesera/QueseraListTask.vue';
import InputAutoPost from '@/actions/InputAutoPost.vue';

const menus = [
    "Board",
    "List",
    "Activity Log",
    "Access",
]

const project = inject<Project>('shared_project');
const menuActive = ref('List');

</script>

<template>
    <div class="flex flex-col">
        <div class="flex justify-between items-center pl-[.8em] border-b border-dashed h-[1.8em]">
            <p class="font-bold text-[.6em] text-white/50 uppercase">{{ project!.type }}'s Project</p>
        </div>
        <div class="px-[.8em] py-[.4em] h-[calc(3*1.8em)]">
            <InputAutoPost :title="'Update Project'" :url="route('projects.update', { project_key: project!.key })" :input-value="project!.name" class="font-bold text-[2.4em]" />
            <p class="opacity-50">Key: <span class="font-bold">{{ project!.key }}</span></p>
        </div>
        <div class="flex items-center gap-[1em] px-[.8em] border-y border-dashed h-[1.8em] uppercase">
            <div v-for="(menu, index) in menus" :key="index" @click="() => menuActive = menu" class="hover:opacity-100 text-[.8em] cursor-pointer" :class="menuActive != menu ? 'opacity-40' : 'opacity-100'" v-html="menu"></div>
        </div>
        <QueseraListTask v-if="menuActive == 'List'" :project="project!" />
    </div>
</template>