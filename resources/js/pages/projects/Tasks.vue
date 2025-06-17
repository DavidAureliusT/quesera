<script setup lang="ts">
import { Project, Task } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Plus, LoaderCircle } from 'lucide-vue-next';

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'

interface Props {
    project: Project;
    tasks: Task[];
}

interface Emits {
    openTask: [task: Task]
}

const props = defineProps<Props>()
defineEmits<Emits>()

const form = useForm({
    summary: '',
});

const submit = () => {
    form.post(route('projects.tasks.store', { project_key: props.project.key }));
};
</script>

<template>
    <Table>
        <TableCaption>A list of your tasks.</TableCaption>
        <TableHeader>
            <TableRow>
                <TableHead class="w-[100px]">
                    Key
                </TableHead>
                <TableHead>Summary</TableHead>
                <TableHead class="text-right">
                    Point
                </TableHead>
                <TableHead>Status</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="task in tasks" :key="task.key" @click="$emit('openTask', task)">
                <TableCell class="font-medium">
                    {{ task.key }}
                </TableCell>
                <TableCell>{{ task.summary }}</TableCell>
                <TableCell class="text-right">
                    {{ task.point }}
                </TableCell>
                <TableCell>
                    <Badge v-if="task.status_category == 'To do'" variant="secondary">{{ task.status_name }}</Badge>
                    <Badge v-if="task.status_category == 'In Progress'" variant="secondary" class="bg-blue-800">{{ task.status_name }}</Badge>
                    <Badge v-if="task.status_category == 'Done'" variant="secondary" class="bg-green-800">{{ task.status_name }}</Badge>
                </TableCell>
            </TableRow>
            <TableRow>
                <Dialog>
                    <DialogTrigger as-child>
                        <TableCell :colspan="4">
                            <div class="flex items-center gap-2 opacity-50 hover:opacity-80">
                                <Plus :size="14" />
                                <p>What needs to be done?</p>
                            </div>
                        </TableCell>
                    </DialogTrigger>
                    <DialogContent class="sm:max-w-[425px]">
                        <form @submit.prevent="submit" class="flex flex-col gap-2">
                            <DialogHeader>
                                <DialogTitle>Create Task</DialogTitle>
                                <DialogDescription>
                                    {{ project.key }} - {{ project.name }}
                                </DialogDescription>
                            </DialogHeader>
                            <div class="flex flex-col gap-[1.2em] pt-[.8em] pb-[1.2em]">
                                <div class="gap-2 grid">
                                    <Label for="task_summary">Summary<span aria-hidden="true" title="required" class="text-orange-600">*</span></Label>
                                    <Input id="task_summary" class="" type="text" required autofocus :tabindex="1" autocomplete="task_summary" v-model="form.summary" placeholder="What needs to be done?" />
                                    <InputError :message="form.errors.summary" />
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
            </TableRow>
        </TableBody>
    </Table>
</template>