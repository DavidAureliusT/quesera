<script setup lang="ts">
import { ChevronUp, ChevronDown, ChevronsUpDown } from "lucide-vue-next";

interface Props {
    sorting: {
        name: string,
        email: string,
        role_id: string,
    }
}

defineEmits<{
    updateFilter: [column: string, order: string]
}>()

defineProps<Props>()

</script>

<template>
    <div class="flex flex-row border-t">
        <div class="flex flex-1 justify-between items-center px-[.8em] border-b h-[1.8em] align-middle">
            <p class="text-white/50">Name</p>
            <ChevronsUpDown @click="$emit('updateFilter', 'name', 'ascending')" v-if="sorting.name == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronUp @click="$emit('updateFilter', 'name', 'descending')" v-if="sorting.name == 'ascending'" :size="16" class="opacity-80 hover:opacity-100" />
            <ChevronDown @click="$emit('updateFilter', 'name', 'default')" v-if="sorting.name == 'descending'" :size="16" class="opacity-80 hover:opacity-100" />
        </div>
        <div class="flex flex-1 justify-between items-center px-[.8em] border-b h-[1.8em] align-middle">
            <p class="text-white/50">Email</p>
            <ChevronsUpDown @click="$emit('updateFilter', 'email', 'ascending')" v-if="sorting.email == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronUp @click="$emit('updateFilter', 'email', 'descending')" v-if="sorting.email == 'ascending'" :size="16" class="opacity-80 hover:opacity-100" />
            <ChevronDown @click="$emit('updateFilter', 'email', 'default')" v-if="sorting.email == 'descending'" :size="16" class="opacity-80 hover:opacity-100" />
        </div>
        <div class="flex flex-1 justify-between items-center px-[.8em] border-b h-[1.8em] text-right">
            <p class="text-white/50">Role</p>
            <ChevronsUpDown @click="$emit('updateFilter', 'role_id', 'ascending')" v-if="sorting.role_id == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronUp @click="$emit('updateFilter', 'role_id', 'descending')" v-if="sorting.role_id == 'ascending'" :size="16" class="opacity-80 hover:opacity-100" />
            <ChevronDown @click="$emit('updateFilter', 'role_id', 'default')" v-if="sorting.role_id == 'descending'" :size="16" class="opacity-80 hover:opacity-100" />
        </div>
    </div>
</template>