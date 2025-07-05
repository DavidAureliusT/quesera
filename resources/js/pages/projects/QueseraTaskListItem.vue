<template>
    <div class="table-row hover:bg-white/10 divide-x">
        <div class="table-cell px-[.8em] border-b h-[1.8em] align-middle">
            <p>{{ task.key }}</p>
        </div>
        <div class="table-cell px-[.8em] border-b h-[1.8em] align-middle">
            <form @submit.prevent="blurActiveElement">
                <input type="text" v-model="taskForm.summary" class="focus:outline-0 w-full" @blur="submit">
                <input type="submit" hidden />
            </form>
        </div>
        <div class="table-cell px-[.8em] border-b h-[1.8em] align-middle">
            <form @submit.prevent="blurActiveElement">
                <input type="number" v-model="taskForm.point" min="1" max="5" class="focus:outline-0 w-full focus:text-left text-right" @blur="submit">
                <input type="submit" hidden />
            </form>
        </div>
        <DropdownMenu>
            <DropdownMenuTrigger as-child>
                <div class="table-cell px-[.8em] border-b h-[2em] align-middle">
                    <div :class="{
                        'bg-white text-black': task.status_category == 'To do',
                        'bg-blue-300 text-black': task.status_category == 'In Progress',
                        'bg-green-300 text-black': task.status_category == 'Done',
                    }" class="px-[.4em] py-[.3em] rounded w-fit font-bold text-[.8em] uppercase leading-[1em]">{{ task.status_name }}</div>
                </div>
            </DropdownMenuTrigger>
            <DropdownMenuContent class="w-48">
                <DropdownMenuRadioGroup v-model="taskForm.status_id" v-on:vue:updated="submit">
                    <DropdownMenuLabel>To do</DropdownMenuLabel>
                    <DropdownMenuRadioItem v-for="(workflow) in workflows.filter((workflow) => workflow.category == 'To do')" :key="workflow.id" :value="workflow.id">
                        <div class="bg-white px-[.4em] py-[.3em] rounded w-fit font-bold text-[.8em] text-black uppercase leading-[1em]">
                            {{ workflow.name }}
                        </div>
                    </DropdownMenuRadioItem>
                    <DropdownMenuLabel>In Progress</DropdownMenuLabel>
                    <DropdownMenuRadioItem v-for="(workflow) in workflows.filter((workflow) => workflow.category == 'In Progress')" :key="workflow.id" :value="workflow.id">
                        <div class="bg-blue-300 px-[.4em] py-[.3em] rounded w-fit font-bold text-[.8em] text-black uppercase leading-[1em]">
                            {{ workflow.name }}
                        </div>
                    </DropdownMenuRadioItem>
                    <DropdownMenuLabel>Done</DropdownMenuLabel>
                    <DropdownMenuRadioItem v-for="(workflow) in workflows.filter((workflow) => workflow.category == 'Done')" :key="workflow.id" :value="workflow.id">
                        <div class="bg-green-300 px-[.4em] py-[.3em] rounded w-fit font-bold text-[.8em] text-black uppercase leading-[1em]">
                            {{ workflow.name }}
                        </div>
                    </DropdownMenuRadioItem>
                </DropdownMenuRadioGroup>
            </DropdownMenuContent>
        </DropdownMenu>
    </div>
</template>

<script setup lang="ts">
import { Task, Workflow } from '@/types';
import { useForm } from '@inertiajs/vue3';

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuLabel,
    DropdownMenuRadioGroup,
    DropdownMenuRadioItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

import { useToast } from '@/components/ui/toast/use-toast'

const { toast } = useToast()

interface Props {
    task: Task
    workflows: Workflow[]
}

const props = defineProps<Props>()

const taskForm = useForm({
    summary: props.task.summary,
    point: props.task.point,
    status_id: props.task.status_id,
});

const blurActiveElement = () => {
    const activeElement = document.activeElement;
    if (activeElement instanceof HTMLElement) {
        activeElement.blur();
    }
}

const submit = () => {
    if (taskForm.isDirty) {
        taskForm.put(route('projects.tasks.update', {
            project_key: props.task.key.split('-')[0],
            task_key: props.task.key,
        }), {
            onSuccess: () => {
                toast({
                    title: 'Update Task',
                    description: JSON.stringify(taskForm.data()),
                });
            }
        });
    }
}
</script>