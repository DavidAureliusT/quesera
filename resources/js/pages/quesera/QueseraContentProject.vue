<script setup lang="ts">
import { ref } from 'vue';
import { Project } from '@/types';
import { useForm } from '@inertiajs/vue3';
import QueseraListTask from './QueseraListTask.vue';
import { useToast } from '@/components/ui/toast/use-toast'

const { toast } = useToast()

const menus = [
    // "Summary",
    // "Timeline",
    "Board",
    // "Calendar",
    "List",
    "Activity Log",
    "Members",
    // "Goals",
    // "Development",
    // "Settings"
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
    <div class="flex flex-col">
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
            <div v-for="(menu, index) in menus" :key="index" @click="selectMenu(menu)" class="hover:opacity-100 text-[.8em] cursor-pointer" :class="menuActive != menu ? 'opacity-40' : 'opacity-100'" v-html="menu"></div>
        </div>
        <div v-if="menuActive == 'List'">
            <QueseraListTask :project="project" />
        </div>
        <div v-if="menuActive == 'Board'">
            <div class="place-items-center grid bg-black min-h-[calc(100vh-(7*1.8em))]">
                <p>Board</p>
            </div>
        </div>
        <div v-if="menuActive == 'Activity Log'">
            <div class="place-items-center grid bg-black min-h-[calc(100vh-(7*1.8em))]">
                <p>Activity Log</p>
            </div>
        </div>
        <div v-if="menuActive == 'Members'">
            <div class="place-items-center grid bg-black min-h-[calc(100vh-(7*1.8em))]">
                <p>Members</p>
            </div>
        </div>
    </div>
</template>