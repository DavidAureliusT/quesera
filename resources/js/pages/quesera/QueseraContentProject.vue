<script setup lang="ts">
import { ref } from 'vue';
import { Project } from '@/types';
import QueseraListTask from './QueseraListTask.vue';
import QueseraListAccess from './QueseraListAccess.vue';
import QueseraContentProjectTopBar from './QueseraContentProjectTopBar.vue';
import QueseraContentProjectHeader from './QueseraContentProjectHeader.vue';
import QueseraContentProjectMenu from '@/pages/quesera/QueseraContentProjectMenu.vue';

interface Props {
    project: Project
}

defineProps<Props>();

const menuActive = ref('Access');

</script>

<template>
    <div class="flex flex-col">
        <QueseraContentProjectTopBar :project_type="project.type" />
        <QueseraContentProjectHeader :project="project" />
        <QueseraContentProjectMenu :selected-menu="menuActive" @change-menu="(value) => menuActive = value" />
        <QueseraListTask v-if="menuActive == 'List'" :project="project" />
        <QueseraListAccess v-if="menuActive == 'Access'" :project="project" />
        <div v-if="menuActive == 'Board'" class="place-items-center grid bg-black min-h-[calc(100vh-(7*1.8em))]">
            <p>Board</p>
        </div>
        <div v-if="menuActive == 'Activity Log'" class="place-items-center grid bg-black min-h-[calc(100vh-(7*1.8em))]">
            <p>Activity Log</p>
        </div>
    </div>
</template>