<template>
    <div class="flex flex-row hover:bg-white/10">
        <div class="flex flex-1 items-center px-[.8em] border-b">
            <div class="flex items-center gap-[.8em] py-[.8em]">
                <div class="place-items-center grid bg-white rounded-full w-[1.8em] aspect-square text-black">
                    <p class="font-bold leading-0">
                        {{ access ? access.name.slice(0, 2).toUpperCase() : page.props.auth.user.name.slice(0, 2).toUpperCase() }}
                    </p>
                </div>
                <p>{{ access ? access.name : page.props.auth.user.name }}</p>
            </div>
        </div>
        <div class="flex flex-1 items-center px-[.8em] border-b">
            <!-- <p>{{ access.email }}</p> -->
            <p>{{ access ? access.email : page.props.auth.user.email }}</p>
        </div>
        <DropdownMenu>
            <DropdownMenuTrigger as-child>
                <div class="flex flex-1 items-center px-[.8em] border-b">
                    <!-- <p>{{ access.role_id }}</p> -->
                    <p>Administrator</p>
                </div>
            </DropdownMenuTrigger>
            <DropdownMenuContent class="w-48">
                <DropdownMenuRadioGroup v-model="accessForm.role_id" v-on:vue:updated="submit">
                    <DropdownMenuRadioItem v-for="(role) in page.props.compas.roles" :key="role.id" :value="role.id">{{ role.name }}</DropdownMenuRadioItem>
                </DropdownMenuRadioGroup>
            </DropdownMenuContent>
        </DropdownMenu>
    </div>
</template>

<script setup lang="ts">
import { Access } from '@/types';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuRadioItem,
    DropdownMenuTrigger,
    DropdownMenuRadioGroup,
} from '@/components/ui/dropdown-menu'

import { usePage, useForm } from "@inertiajs/vue3";
import { useToast } from '@/components/ui/toast/use-toast'

const page = usePage();
const { toast } = useToast()

interface Props {
    access?: Access
}

const props = defineProps<Props>()

const accessForm = useForm({
    role_id: props.access ? props.access.role_id : '1',
});


const submit = () => {
    if (accessForm.isDirty) {
        accessForm.put(route('projects.access.update', {
            // project_key: props.access.key.split('-')[0],
            // task_key: props.task.key,
        }), {
            onSuccess: () => {
                toast({
                    title: 'Update Task',
                    description: JSON.stringify(accessForm.data()),
                });
            }
        });
    }
}

</script>