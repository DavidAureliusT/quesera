<script setup lang="ts">
import { inject } from 'vue';
import { Project } from '@/types';
// import QueseraListTask from '@/components/_quesera/QueseraListTask.vue';
// import AutoPostInput from '@/actions/AutoPostInput.vue';

// const menus = [
//     "Board",
//     "List",
//     "Activity Log",
//     "Access",
// ]

const project = inject<Project>('shared_project');
// const menuActive = ref('List');

</script>

<template>
    <div class="grid grid-cols-3">
        <div class="flex flex-col">
            <div class="place-items-center grid">
                <small class="bg-white m-[.4em] p-[.2em] px-[.8em] rounded-full w-fit text-black text-center">To do</small>
            </div>
            <div v-for="(task, index) in project!.tasks?.filter((task) => task.status_name == 'To do')" :key="index" class="flex">
                <div class="flex-none px-[.2em] border border-dashed w-[1.8em]">
                    {{ task.id }}
                </div>
                <div class="flex-none px-[.2em] border border-dashed w-[4em]">
                    {{ task.key }}
                </div>
                <div class="flex-1 px-[.2em] border border-dashed">
                    {{ task.summary }}
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="place-items-center grid">
                <small class="bg-white m-[.4em] p-[.2em] px-[.8em] rounded-full w-fit text-black text-center">In Progress</small>
            </div>
            <div v-for="(task, index) in project!.tasks?.filter((task) => task.status_name == 'In Progress')" :key="index" class="flex">
                <div class="flex-none px-[.2em] border border-dashed w-[1.8em]">
                    {{ task.id }}
                </div>
                <div class="flex-none px-[.2em] border border-dashed w-[4em]">
                    {{ task.key }}
                </div>
                <div class="flex-1 px-[.2em] border border-dashed">
                    {{ task.summary }}
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="place-items-center grid">
                <small class="bg-white m-[.4em] p-[.2em] px-[.8em] rounded-full w-fit text-black text-center">Done</small>
            </div>
            <div v-for="(task, index) in project!.tasks?.filter((task) => task.status_name == 'Done')" :key="index" class="flex">
                <div class="flex-none px-[.2em] border border-dashed w-[1.8em]">
                    {{ task.id }}
                </div>
                <div class="flex-none px-[.2em] border border-dashed w-[4em]">
                    {{ task.key }}
                </div>
                <div class="flex-1 px-[.2em] border border-dashed">
                    {{ task.summary }}
                </div>
            </div>
        </div>
    </div>
    <!-- <pre>{{ project!.tasks }}</pre> -->

    <!-- <div class="flex flex-col">
        <div class="flex justify-between items-center pl-[.8em] border-b border-dashed h-[1.8em]">
            <p class="font-bold text-[.6em] text-white/50 uppercase">{{ project!.type }}'s Project</p>
        </div>
        <div class="px-[.8em] py-[.4em] h-[calc(3*1.8em)]">
            <AutoPostInput :title="'Update Project'" :url="route('projects.update', { project_key: project!.key })" :input-value="project!.name" class="font-bold text-[2.4em]" />
            <p class="opacity-50">Key: <span class="font-bold">{{ project!.key }}</span></p>
        </div>
        <div class="flex items-center gap-[1em] px-[.8em] border-y border-dashed h-[1.8em] uppercase">
            <div v-for="(menu, index) in menus" :key="index" @click="() => menuActive = menu" class="hover:opacity-100 text-[.8em] cursor-pointer" :class="menuActive != menu ? 'opacity-40' : 'opacity-100'" v-html="menu"></div>
        </div>
        <QueseraListTask v-if="menuActive == 'List'" :project="project!" />
    </div> -->
</template>