<script setup lang="ts">
import { Task } from '@/types';

import AutoSubmitInput from '@/actions/AutoSubmitInput.vue';
import BadgeStatus from './BadgeStatus.vue';

defineProps<{ task: Task }>()

</script>

<template>
    <div class="flex flex-row hover:bg-white/10 divide-x">
        <div class="px-[.8em] border-b w-[8em] h-[1.8em] align-middle">
            <p>{{ task.key }}</p>
        </div>
        <div class="flex-1 px-[.8em] border-b h-[1.8em] align-middle">
            <AutoSubmitInput type="text" method="put" :url="route('projects.tasks.update', { project_key: task.key.split('-')[0], task_key: task.key })" attribute-name="summary" :input-value="task.summary" title="Task Updated" />
        </div>
        <div class="px-[.8em] border-b w-[6em] h-[1.8em] text-center align-middle">
            <AutoSubmitInput type="number" method="put" :url="route('projects.tasks.update', { project_key: task.key.split('-')[0], task_key: task.key })" attribute-name="point" :input-value="task.point" title="Task Updated" />
        </div>
        <div class="items-center place-items-center grid px-[.8em] border-b w-[8em] h-[1.8em]">
            <!-- AutoPostDropdown -->
            <BadgeStatus :status_category="task.status_category" :status_name="task.status_name" />
        </div>
    </div>
</template>