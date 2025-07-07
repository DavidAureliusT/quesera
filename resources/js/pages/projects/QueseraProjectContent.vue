<script setup lang="ts">
import { Project } from '@/types';
import { ref } from 'vue';
import QueseraTaskList from './QueseraTaskList.vue';

const menus = [
    "Summary",
    "Timeline",
    "Board",
    "Calendar",
    "List",
    "Goals",
    "Development",
    "Settings"
];

const menuActive = ref('List');

function selectMenu(menu: string) {
    menuActive.value = menu;
}

interface Props {
    project: Project
}

defineProps<Props>();

</script>

<template>
    <div class="p-[.8em]">
        <div class="flex items-center gap-[1em] mb-[.4em]">
            <div class="bg-white px-[.4em] py-[.1em] rounded w-fit text-black uppercase leading-[1em]">
                <small class="font-semibold">{{ project.type }}'s Project</small>
            </div>
        </div>
        <h1>{{ project.name }}</h1>
        <p>Key: <span class="font-bold">{{ project.key }}</span></p>
    </div>
    <div class="flex gap-[1em] px-[.8em] border-y uppercase">
        <p v-for="(menu, index) in menus" :key="index" @click="selectMenu(menu)" class="hover:opacity-100 cursor-pointer" :class="{
            'opacity-40': menuActive != menu,
            'opacity-100': menuActive == menu
        }" v-html="menu"></p>
    </div>
    <div class="p-[.8em]">
        <!-- <h2>{{ menuActive }}</h2> -->
    </div>
    <QueseraTaskList :project="project" v-if="menuActive == 'List'" />
</template>