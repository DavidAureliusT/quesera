<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { type NavItem, type Project } from '@/types';
import SandboxLayout from '@/layouts/SandboxLayout.vue';
import TextLink from "@/components/TextLink.vue";
import { Badge } from '@/components/ui/badge';


interface Props {
    projects?: Project[];
}

withDefaults(defineProps<Props>(), {
    projects: () => []
})

const createProject: NavItem = {
    title: 'Create project',
    href: '/projects/create'
};

</script>

<template>

    <Head title="Projects"></Head>
    <SandboxLayout>
        <main class="flex flex-col w-[800px] max-w-[800px]">
            <div class="mb-3">
                <div class="flex justify-between">
                    <div></div>
                    <TextLink :href="createProject.href">{{ createProject.title }}</TextLink>
                </div>
                <div class="pb-3 border-b">
                    <h1>Projects</h1>
                </div>
            </div>
            <div v-for="(project, index) in projects" :key="index">
                <Link :href="'/projects/' + project.key">
                <div class="flex gap-[1.2em] hover:bg-white/10 mb-2 p-2 border rounded-lg transition-all">
                    <p class="flex-none w-12 text-right">{{ project.id }}</p>
                    <p class="flex-none w-12">{{ project.key }}</p>
                    <p class="flex-1">{{ project.name }}</p>
                    <Badge class="uppercase">{{ project.type }}</Badge>
                </div>
                </Link>
            </div>
        </main>
    </SandboxLayout>
</template>