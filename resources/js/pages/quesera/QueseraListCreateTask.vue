<template>
    <div class="flex flex-row hover:bg-white/10">
        <div class="flex-none px-[.8em] border-t w-[8em] h-[1.8em] align-middle"></div>
        <div class="flex-1 px-[.8em] border-t h-[1.8em] align-middle">
            <form @submit.prevent="blurActiveElement">
                <input type="text" placeholder="What's need to be done?" v-model="newTaskForm.summary" @blur="submit" class="w-full placeholder:text-[.8em]">
                <input type="submit" hidden />
            </form>
        </div>
        <div class="px-[.8em] border-t w-[4em] h-[1.8em] align-middle"></div>
        <div class="px-[.8em] border-t w-[10em] h-[1.8em] align-middle"></div>
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