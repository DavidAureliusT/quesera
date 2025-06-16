<script setup lang="ts">
import { Project, NavItem } from "@/types";
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { LoaderCircle } from 'lucide-vue-next';
import InputError from '@/components/InputError.vue';
import TextLink from "@/components/TextLink.vue";
import SandboxLayout from '@/layouts/SandboxLayout.vue';

import { Head, useForm } from '@inertiajs/vue3';

interface Props {
    project: Project
}

const props = defineProps<Props>()

const allProjects: NavItem = {
    title: 'Back to project ' + props.project.key,
    href: '/projects/' + props.project.key
};

const form = useForm({
    summary: '',
});

const submit = () => {
    form.post(route('projects.tasks.store', { project_key: props.project.key }));
};

</script>

<template>

    <Head title="Create Task"></Head>
    <SandboxLayout>
        <main class="flex flex-col max-w-[560px]">
            <TextLink :href="allProjects.href">{{ allProjects.title }}</TextLink>
            <form @submit.prevent="submit" class="flex flex-col gap-2">
                <div class="">
                    <h1 class="dark:text-[#EDEDEC]">Task of {{ project.key }} - {{ project.name }}</h1>
                </div>
                <div class="flex flex-col gap-[1.2em] pt-[.8em] pb-[1.2em]">
                    <div class="gap-2 grid">
                        <Label for="task_summary">Summary<span aria-hidden="true" title="required" class="text-orange-600">*</span></Label>
                        <Input id="task_summary" class="" type="text" required autofocus :tabindex="1" autocomplete="task_summary" v-model="form.summary" placeholder="What needs to be done?" />
                        <InputError :message="form.errors.summary" />
                    </div>
                </div>
                <Button type="submit" class="flex-none" :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="w-4 h-4 animate-spin" />
                    Create
                </Button>
            </form>
        </main>
    </SandboxLayout>

</template>