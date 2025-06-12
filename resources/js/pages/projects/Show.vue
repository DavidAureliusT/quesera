<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import SandboxLayout from '@/layouts/SandboxLayout.vue';

defineProps<{
    project: {
        name?: string
        key?: string
    }
}>()
</script>

<template>

    <Head :title="project.key + ' board'"></Head>
    <SandboxLayout>
        <main class="flex flex-col max-w-[800px]">
            <h1>{{ project.key }} - {{ project.name }}</h1>
        </main>
    </SandboxLayout>
</template>