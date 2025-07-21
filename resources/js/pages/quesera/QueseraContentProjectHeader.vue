<template>
    <div class="px-[.8em] py-[.4em]">
        <form @submit.prevent="blurActiveElement">
            <input type="text" v-model="projectForm.name" @blur="submit" class="font-bold text-[2.4em] leading-0">
            <input type="submit" hidden />
        </form>
        <p class="opacity-50">Key: <span class="font-bold">{{ project.key }}</span></p>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Project } from "@/types";
import { useToast } from '@/components/ui/toast/use-toast'

const props = defineProps<{ project: Project }>()

const { toast } = useToast()

const projectForm = useForm({
    name: props.project.name
})

const blurActiveElement = () => {
    const activeElement = document.activeElement;
    if (activeElement instanceof HTMLElement) {
        activeElement.blur();
    }
}

const submit = () => {
    if (projectForm.isDirty) {
        projectForm.put(route('projects.update', {
            project_key: props.project.key,
        }), {
            onSuccess: () => {
                toast({
                    title: 'Update Project',
                    description: JSON.stringify(projectForm.data()),
                });
            }
        });
    }
}
</script>