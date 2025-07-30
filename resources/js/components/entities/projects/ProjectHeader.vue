<script setup lang="ts">
import { HTMLAttributes } from 'vue';
import { Project } from '@/types';
import { cn } from '@/lib/utils'
import InputAutoPost from '@/actions/InputAutoPost.vue';

interface Props {
    class?: HTMLAttributes['class'],
    project: Project
}
const props = defineProps<Props>();

</script>

<template>
    <div :class="cn('px-[.8em] py-[.4em]', props.class)">
        <InputAutoPost :title="'Update Project'" :url="route('projects.update', { project_key: project.key })" :input-value="project.name" class="font-bold text-[2.4em]" />
        <p class="opacity-50">Key: <span class="font-bold">{{ project.key }}</span></p>
    </div>
</template>