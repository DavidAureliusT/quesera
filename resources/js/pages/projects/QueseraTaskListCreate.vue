<template>
    <div class="table-row hover:bg-white/10 divide-x">
        <div class="table-cell px-[.8em] border-b h-[1.8em] align-middle"></div>
        <div class="table-cell px-[.8em] border-b h-[1.8em] align-middle">
            <form @submit.prevent="blurActiveElement">
                <input type="text" class="focus:outline-0 w-full placeholder:text-[.8em]" placeholder="What's need to be done?" v-model="newTaskForm.summary" @blur="submit">
                <input type="submit" hidden />
            </form>
        </div>
        <div class="table-cell px-[.8em] border-b h-[1.8em] align-middle"></div>
        <div class="table-cell px-[.8em] border-b h-[1.8em] align-middle"></div>
    </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { useToast } from '@/components/ui/toast/use-toast'

const { toast } = useToast()

const newTaskForm = useForm({
    summary: ""
});

interface Props {
    project_key: string
}

const props = defineProps<Props>()

const blurActiveElement = () => {
    const activeElement = document.activeElement;
    if (activeElement instanceof HTMLElement) {
        activeElement.blur();
    }
}

const submit = () => {
    if (newTaskForm.summary.length && newTaskForm.isDirty) {
        newTaskForm.post(route('projects.tasks.store', {
            project_key: props.project_key,
        }), {
            onSuccess: () => {
                toast({
                    title: 'New Task',
                    description: 'New task created successfully',
                });
                newTaskForm.reset();
            }
        });
    }
}
</script>