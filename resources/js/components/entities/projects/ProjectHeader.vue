<script setup lang="ts">
import { HTMLAttributes } from 'vue';
import { Project } from '@/types';
import { cn } from '@/lib/utils'
import AutoPostInput from '@/actions/AutoPostInput.vue';

interface Props {
    class?: HTMLAttributes['class'],
    project: Project
}
const props = defineProps<Props>();

</script>

<template>
    <div :class="cn('px-[.8em] py-[.4em]', props.class)">
        <AutoPostInput type="text" class="border-b border-dashed font-bold text-[2.4em]" :url="route('projects.update', { project_key: project.key })" attribute-name="name" :input-value="project.name" title="Update Project" />
        <p class="opacity-50">Key: <span class="font-bold">{{ project.key }}</span></p>
    </div>
</template>