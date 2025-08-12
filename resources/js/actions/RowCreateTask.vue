<template>
    <div class="flex flex-row hover:bg-white/10">
        <div class="flex-none px-[.8em] border-t w-[8em] h-[1.8em] align-middle"></div>
        <div class="flex-1 px-[.8em] border-t h-[1.8em] align-middle">
            <AutoSubmitInput type="text" method="post" :url="route('projects.tasks.store', { project_key: project_key, })" attribute-name="summary" title="New Task" :use-reset="true" />
        </div>
        <div class="px-[.8em] border-t w-[6em] h-[1.8em] align-middle"></div>
        <div class="px-[.8em] border-t w-[8em] h-[1.8em] align-middle"></div>
    </div>
</template>

<script setup lang="ts">
import AutoSubmitInput from './AutoSubmitInput.vue';

interface Props {
    project_key: string
}

defineProps<Props>()

</script>