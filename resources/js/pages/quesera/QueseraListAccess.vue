<script setup lang="ts">
import { Project, Access } from "@/types";
import { reactive, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";
import QueseraListHeaderAccess from "./QueseraListHeaderAccess.vue";
import QueseraListItemAccess from "./QueseraListItemAccess.vue";
import { Button } from "@/components/ui/button";

interface Props {
    project: Project
}

const props = defineProps<Props>();

const page = usePage();

const filters = reactive({
    sorting: {
        name: 'default',
        email: 'default',
        role_id: 'default',
    }
})

const filteredAccesses = reactive<{ data: Access[] }>({ data: [] })

watchEffect(() => {
    filteredAccesses.data = [...(props.project.accesses || [])]
        .sort((a: Access, b: Access) => {
            // Sort by name (alphabetically)
            if (filters.sorting.name !== 'default') {
                const comparison = a.name.localeCompare(b.name);
                if (comparison !== 0) {
                    return filters.sorting.name === 'ascending' ? comparison : -comparison;
                }
            }
            // Sort by email (alphabetically)
            if (filters.sorting.email !== 'default') {
                const comparison = a.email.localeCompare(b.email);
                if (comparison !== 0) {
                    return filters.sorting.email === 'ascending' ? comparison : -comparison;
                }
            }

            // Sort by role_id
            if (filters.sorting.role_id !== 'default') {
                const statusA = parseInt(a.role_id);
                const statusB = parseInt(b.role_id);
                if (statusA !== statusB) {
                    return filters.sorting.role_id === 'ascending' ? statusA - statusB : statusB - statusA;
                }
            }

            return 0; // Keep original order if equal or default
        })
})

function handleUpdateSorting(column: string, order: string) {
    if (column == 'name') filters.sorting.name = order;
    if (column == 'email') filters.sorting.email = order;
    if (column == 'role_id') filters.sorting.role_id = order;
}

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'

</script>

<template>
    <div class="h-[calc(100vh-(2*1.8em)-(5*1.8em))] overflow-y-scroll">

        <div class="flex flex-row justify-between gap-[.4em] p-[.8em]">
            <Select>
                <SelectTrigger class="w-[180px]">
                    <SelectValue placeholder="Roles" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem key="0" :value="0">All</SelectItem>
                        <SelectItem v-for="(role) in page.props.compas.roles" :key="role.id" :value="role.id">{{ role.name }}</SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
            <Button variant="default" size="default">Add people</Button>
        </div>

        <QueseraListHeaderAccess :sorting="filters.sorting" @update-filter="handleUpdateSorting" />
        <QueseraListItemAccess v-for="(access) in props.project.accesses" :key="access.id" :access="access" />

    </div>
</template>