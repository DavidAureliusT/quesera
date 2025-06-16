<script setup lang="ts">
import { Project, NavItem } from "@/types";
import { Head } from '@inertiajs/vue3';
import TextLink from "@/components/TextLink.vue";
import SandboxLayout from '@/layouts/SandboxLayout.vue';
import { Badge } from '@/components/ui/badge';
import Tasks from "./Tasks.vue";

interface Props {
    project: Project
}

const props = defineProps<Props>()

const allProjects: NavItem = {
    title: 'Back to all projects',
    href: '/projects'
};

const createTask: NavItem = {
    title: 'Create task',
    href: '/projects/' + props.project.key + '/tasks/create'
};

</script>

<template>

    <Head :title="project.key + ' Project'"></Head>
    <SandboxLayout>
        <main class="flex flex-col max-w-[800px]">
            <div class="flex justify-between">
                <TextLink :href="allProjects.href">{{ allProjects.title }}</TextLink>
                <TextLink :href="createTask.href">{{ createTask.title }}</TextLink>
            </div>
            <div class="mt-[1.2em]">
                <Badge class="uppercase">{{ project.type }} Workflow</Badge>
                <div class="flex gap-2 mt-4">
                    <div v-for="(status, index) in project.workflows" :key="status.id">
                        <span class="pr-2">
                            <Badge v-if="status.category == 'To do'" variant="secondary">{{ status.name }}</Badge>
                            <Badge v-if="status.category == 'In Progress'" variant="secondary" class="bg-blue-800">{{ status.name }}</Badge>
                            <Badge v-if="status.category == 'Done'" variant="secondary" class="bg-green-800">{{ status.name }}</Badge>
                        </span> <span v-if="index < project.workflows!.length - 1"> -> </span>
                    </div>
                </div>
                <h1>{{ project.key }} - {{ project.name }}</h1>
            </div>
            <Tasks :tasks="project.tasks!"></Tasks>
        </main>
    </SandboxLayout>
</template>