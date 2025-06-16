<script setup lang="ts">
import { Project, Task, NavItem } from "@/types";
import { Head } from '@inertiajs/vue3';
import TextLink from "@/components/TextLink.vue";
import SandboxLayout from '@/layouts/SandboxLayout.vue';
import { Badge } from '@/components/ui/badge';


import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

interface Props {
    project: Project,
    tasks: Task[]
}

const props = defineProps<Props>()

const allProjects: NavItem = {
    title: 'Back to all projects',
    href: '/projects'
};

const createTask: NavItem = {
    title: 'Crate task',
    href: '/projects/' + props.project.key + '/tasks/create'
};

</script>

<template>

    <Head :title="project.key"></Head>
    <SandboxLayout>
        <main class="flex flex-col max-w-[800px]">
            <div class="flex justify-between">
                <TextLink :href="allProjects.href">{{ allProjects.title }}</TextLink>
                <TextLink :href="createTask.href">{{ createTask.title }}</TextLink>
            </div>
            <div class="mt-[1.2em]">
                <Badge class="uppercase">{{ project.type }}</Badge>
                <h1>{{ project.key }} - {{ project.name }}</h1>
            </div>
            <Table>
                <TableCaption>A list of your tasks.</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">
                            Key
                        </TableHead>
                        <TableHead>Summary</TableHead>
                        <TableHead class="text-right">
                            Point
                        </TableHead>
                        <TableHead>Status</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="task in tasks" :key="task.key">
                        <TableCell class="font-medium">
                            {{ task.key }}
                        </TableCell>
                        <TableCell>{{ task.summary }}</TableCell>
                        <TableCell class="text-right">
                            {{ task.point }}
                        </TableCell>
                        <TableCell>{{ task.status }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
            <!-- <pre>{{ props }}</pre> -->
        </main>
    </SandboxLayout>
</template>