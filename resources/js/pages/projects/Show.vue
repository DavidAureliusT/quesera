<script setup lang="ts">
import { Project, NavItem, Task } from "@/types";
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import SandboxLayout from '@/layouts/SandboxLayout.vue';
import TextLink from "@/components/TextLink.vue";
import { Badge } from '@/components/ui/badge';
import Tasks from "./Tasks.vue";

import {
    ResizableHandle,
    ResizablePanel,
    ResizablePanelGroup,
} from '@/components/ui/resizable'

interface Props {
    project: Project
}

defineProps<Props>()

const openTask = ref({});

const allProjects: NavItem = {
    title: 'Back to all projects',
    href: '/projects'
};

function handleOpenTask(task: Task) {
    console.log(task);
    openTask.value = task;
}

</script>

<template>

    <Head :title="project.key + ' Project'"></Head>
    <SandboxLayout>
        <ResizablePanelGroup direction="horizontal">
            <ResizablePanel>
                <main class="flex flex-col">
                    <div class="flex justify-between">
                        <TextLink :href="allProjects.href">{{ allProjects.title }}</TextLink>
                    </div>
                    <div class="mt-[1.2em]">
                        <p class="uppercase">{{ project.type }} Workflow</p>
                        <h1>{{ project.name }}</h1>
                        <div class="flex items-center gap-2">
                            <div v-for="(status, index) in project.workflows" :key="status.id">
                                <span class="pr-2">
                                    <Badge v-if="status.category == 'To do'" variant="secondary">{{ status.name }}</Badge>
                                    <Badge v-if="status.category == 'In Progress'" variant="secondary" class="bg-blue-800">{{ status.name }}</Badge>
                                    <Badge v-if="status.category == 'Done'" variant="secondary" class="bg-green-800">{{ status.name }}</Badge>
                                </span> <span v-if="index < project.workflows!.length - 1"> -> </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <Tasks :project="project" :tasks="project.tasks!" v-on:open-task="handleOpenTask"></Tasks>
                    </div>
                </main>
            </ResizablePanel>
            <ResizableHandle with-handle />
            <ResizablePanel :default-size="40">
                Task Detail
                <pre>{{ openTask }}</pre>
            </ResizablePanel>
        </ResizablePanelGroup>
    </SandboxLayout>
</template>