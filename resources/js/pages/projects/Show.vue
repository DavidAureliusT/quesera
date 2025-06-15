<script setup lang="ts">
import { Project } from "@/types";
import { Head } from '@inertiajs/vue3';
import TextLink from "@/components/TextLink.vue";
import SandboxLayout from '@/layouts/SandboxLayout.vue';

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'


const tasks = [
    {
        key: 'QPMT-37',
        summary: "feat: authentication with email verification",
        status: 'Sprint',
        point: 2,
    },
    {
        key: 'QPMT-38',
        summary: "feat: cold-start create personal kanban's project",
        status: 'Sprint',
        point: 2,
    },
    {
        key: 'QPMT-40',
        summary: "feat: update user's profile",
        status: 'Sprint',
        point: 2,
    },
    {
        key: 'QPMT-41',
        summary: "feat: crud task",
        status: "In Progress",
        point: 2,
    },
    {
        key: 'QPMT-44',
        summary: "feat: change kanban view to list view",
        status: "In Progress",
        point: 2,
    },
    {
        key: 'QPMT-45',
        summary: "feat: invite member to project",
        status: "Backlog",
        point: 2,
    },
    {
        key: 'QPMT-46',
        summary: "feat: share kanban to stakeholder (view only)",
        status: 'Sprint',
        point: 2,
    },
    {
        key: 'QPMT-47',
        summary: "feat: member accept project's invitation",
        status: "Backlog",
        point: 2,
    },
    {
        key: 'QPMT-48',
        summary: "feat: send email invitation",
        status: "Backlog",
        point: 2,
    },
    {
        key: 'QPMT-49',
        summary: "feat: redirect to sign up for new user via invitation",
        status: "Backlog",
        point: 2,
    },
    {
        key: 'QPMT-50',
        summary: "feat: member can only update task description and status",
        status: "Backlog",
        point: 2,
    },
    {
        key: 'QPMT-51',
        summary: "feat: member cannot delete task",
        status: "Backlog",
        point: 2,
    },
    {
        key: 'QPMT-52',
        summary: "feat: members are able to create a sub-task",
        status: "Backlog",
        point: 2,
    },
]

interface Props {
    project: Project
}

defineProps<Props>()

const allProjects = {
    title: 'Back to all projects',
    href: '/projects'
};

</script>

<template>

    <Head :title="project.key"></Head>
    <SandboxLayout>
        <main class="flex flex-col max-w-[800px]">
            <TextLink :href="allProjects.href">{{ allProjects.title }}</TextLink>
            <h1>{{ project.key }} - {{ project.name }}</h1>

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
        </main>
    </SandboxLayout>
</template>