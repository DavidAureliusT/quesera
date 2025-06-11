<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { LoaderCircle } from 'lucide-vue-next';
import InputError from '@/components/InputError.vue';
import SandboxLayout from '@/layouts/SandboxLayout.vue';

const form = useForm({
    project_name: '',
    project_key: '',
});

// const autofill_handler = () => { };

const submit = () => {
    form.post(route('projects.store'));
};
</script>

<template>

    <Head title="SMPL board"></Head>
    <SandboxLayout>
        <main class="flex flex-col max-w-[560px]">
            <form @submit.prevent="submit" class="flex flex-col gap-2">
                <div class="">
                    <h1 class="dark:text-[#EDEDEC]">Project</h1>
                </div>
                <div class="">
                    <p>Explore what's possible when you collaborate with your team.</p>
                    <p>Edit project details anytime in project settings.</p>
                    <p>Required fields are marked with an asterisk.<span aria-hidden="true" title="required" class="text-orange-600">*</span></p>
                </div>
                <div class="flex flex-col gap-[1.2em] pt-[.8em] pb-[1.2em]">
                    <div class="gap-2 grid">
                        <Label for="project_name">Name<span aria-hidden="true" title="required" class="text-orange-600">*</span></Label>
                        <Input id="project_name" class="" type="text" required autofocus :tabindex="1" autocomplete="project_name" v-model="form.project_name" placeholder="Try a team name, project goal, milestone..." />
                        <InputError :message="form.errors.project_name" />
                    </div>
                    <div class="gap-2 grid">
                        <Label for="project_key">Key<span aria-hidden="true" title="required" class="text-orange-600">*</span></Label>
                        <Input id="project_key" class="w-[100px]" type="text" required autofocus :tabindex="1" autocomplete="project_key" v-model="form.project_key" />
                        <InputError :message="form.errors.project_key" />
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