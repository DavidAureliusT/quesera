<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { LoaderCircle, Plus } from 'lucide-vue-next';

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
    DialogClose,
} from '@/components/ui/dialog'

import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'

import { useForm } from '@inertiajs/vue3';
import { watch, ref } from 'vue';
import InputError from '@/components/InputError.vue';

const projectTypes = ['basic', 'scrum'];

const form = useForm({
    type: '',
    name: '',
    key: '',
});

const userEditedProjectKey = ref(false);

let projectNameTimer: ReturnType<typeof setTimeout> | null = null;

const submit = () => {
    form.post(route('projects.store'));
};

function getAutoFillProjectKey(project_name: string): string {
    let project_key = "";

    const initial_name = project_name.trim().split(' ');
    initial_name.forEach((word) => {
        if (word != undefined) project_key += word[0];
    });

    if (project_key.length === 1) {
        project_key = initial_name[0].slice(0, 3);
    }
    return project_key.toUpperCase();
}

watch(() => form.key, (newProjectKey) => {
    userEditedProjectKey.value = newProjectKey !== getAutoFillProjectKey(form.name);
});

watch(() => form.name, (newProjectName) => {
    if (projectNameTimer) {
        clearTimeout(projectNameTimer);
    }
    if (newProjectName) {
        projectNameTimer = setTimeout(() => {
            if (!userEditedProjectKey.value) {
                form.key = getAutoFillProjectKey(newProjectName);
            }
            if (!form.key && newProjectName) {
                form.key = getAutoFillProjectKey(newProjectName);
            }
        }, 1000);
    } else {
        if (!userEditedProjectKey.value) {
            form.key = '';
        }
    }
});

</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <div class="hover:bg-white/10 p-[.2em] rounded transition-all">
                <Plus :size="16" />
            </div>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[560px]">
            <form @submit.prevent="submit" class="flex flex-col gap-2">
                <DialogHeader>
                    <DialogTitle>Create project</DialogTitle>
                    <DialogDescription>
                        <p>Explore what's possible when you collaborate with your team.</p>
                        <p>Edit project details anytime in project settings.</p>
                        <p>Required fields are marked with an asterisk.<span aria-hidden="true" title="required" class="text-orange-600">*</span></p>
                    </DialogDescription>
                </DialogHeader>
                <div class="flex flex-col gap-[1.2em] pb-[1.2em]">
                    <div class="gap-2 grid">
                        <Label for="project_type">Type<span aria-hidden="true" title="required" class="text-orange-600" autofocus="">*</span></Label>
                        <Select id="project_type" v-model="form.type" required>
                            <SelectTrigger class="w-[210px]">
                                <SelectValue placeholder="Select a project type" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem v-for="(type, index) in projectTypes" :key="index" :value="type" class="capitalize">
                                    {{ type }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="gap-2 grid">
                        <Label for="project_name">Name<span aria-hidden="true" title="required" class="text-orange-600">*</span></Label>
                        <Input id="project_name" class="" type="text" required autofocus :tabindex="1" autocomplete="project_name" v-model="form.name" placeholder="Try a team name, project goal, milestone..." />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="gap-2 grid">
                        <Label for="project_key">Key<span aria-hidden="true" title="required" class="text-orange-600">*</span></Label>
                        <Input id="project_key" class="w-[100px]" type="text" required autofocus :tabindex="1" autocomplete="project_key" v-model="form.key" />
                        <InputError :message="form.errors.key" />
                    </div>
                </div>
                <DialogFooter>
                    <DialogClose as-child>
                        <Button type="submit" class="flex-none" :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="w-4 h-4 animate-spin" />
                            Create
                        </Button>
                    </DialogClose>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>