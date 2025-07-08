<script setup lang="ts">
import { Project } from '@/types';
import { ref } from 'vue';
import QueseraTaskList from './QueseraTaskList.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from '@/components/ui/toast/use-toast'

const { toast } = useToast()

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

const props = defineProps<Props>();

const projectForm = useForm({
    name: props.project.name
})

const blurActiveElement = () => {
    const activeElement = document.activeElement;
    if (activeElement instanceof HTMLElement) {
        activeElement.blur();
    }
}

const submit = () => {
    if (projectForm.isDirty) {
        projectForm.put(route('projects.update', {
            project_key: props.project.key,
        }), {
            onSuccess: () => {
                toast({
                    title: 'Update Project',
                    description: JSON.stringify(projectForm.data()),
                });
            }
        });
    }
}

</script>

<template>
    <div class="p-[.8em]">
        <div class="flex items-center gap-[1em] mb-[.4em]">
            <div class="bg-white px-[.4em] py-[.1em] rounded w-fit text-black uppercase leading-[1em]">
                <small class="font-semibold">{{ project.type }}'s Project</small>
            </div>
        </div>
        <form @submit.prevent="blurActiveElement">
            <input type="text" v-model="projectForm.name" @blur="submit" class="font-bold text-[2.4em] leading-[1em]">
            <input type="submit" hidden />
        </form>
        <p class="opacity-50">Key: <span class="font-bold">{{ project.key }}</span></p>
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