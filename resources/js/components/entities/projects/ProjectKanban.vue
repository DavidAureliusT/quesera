<script setup lang="ts">
import { Project } from '@/types';

defineProps<{ project?: Project }>()


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
</template>