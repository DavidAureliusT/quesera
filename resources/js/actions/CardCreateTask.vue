<script setup lang="ts">
import { ref } from "vue";
import { Plus } from 'lucide-vue-next';
import AutoSubmitInput from "./AutoSubmitInput.vue";

interface Props { project_key: string, status_id: string }

defineProps<Props>()

const isOpenCardCreateTask = ref<boolean>(false);

</script>
<template>
    <div class="p-[.2em]">
        <div class="bg-[var(--primary-foreground)] border border-primary/10 rounded-[.8em] text-primary transition-all cursor-pointer">
            <div v-if="!isOpenCardCreateTask" @click="isOpenCardCreateTask = !isOpenCardCreateTask">
                <div class="flex gap-[.4em] p-[.8em]">
                    <Plus />
                    <p>Create Task</p>
                </div>
            </div>
            <div v-else>
                <div class="p-[.8em]">
                    <AutoSubmitInput type="text" method="post" :url="route('projects.tasks.store', { project_key: project_key, status_id: status_id })" attribute-name="summary" title="New Task" :use-reset="true" :use-focus="true" @on-blur="isOpenCardCreateTask = !isOpenCardCreateTask" />
                </div>
            </div>
        </div>
    </div>
</template>