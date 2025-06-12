<script setup lang="ts">
import { Project } from "@/types";
import { Head } from '@inertiajs/vue3';
import TextLink from "@/components/TextLink.vue";
import SandboxLayout from '@/layouts/SandboxLayout.vue';

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
        </main>
    </SandboxLayout>
</template>