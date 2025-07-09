<template>
    <div class="flex flex-row bg-white/5 divide-x">
        <div class="flex flex-none justify-between items-center px-[.8em] border-b w-[8em] h-[1.8em] align-middle">
            <p class="text-white/50">Key</p>
            <ChevronsUpDown @click="$emit('updateFilter', 'key', 'ascending')" v-if="sorting.key == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronUp @click="$emit('updateFilter', 'key', 'descending')" v-if="sorting.key == 'ascending'" :size="16" class="opacity-80 hover:opacity-100" />
            <ChevronDown @click="$emit('updateFilter', 'key', 'default')" v-if="sorting.key == 'descending'" :size="16" class="opacity-80 hover:opacity-100" />
        </div>
        <div class="flex flex-1 justify-between items-center px-[.8em] border-b h-[1.8em] align-middle">
            <p class="text-white/50">Summary</p>
            <ChevronsUpDown @click="$emit('updateFilter', 'summary', 'ascending')" v-if="sorting.summary == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronUp @click="$emit('updateFilter', 'summary', 'descending')" v-if="sorting.summary == 'ascending'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronDown @click="$emit('updateFilter', 'summary', 'default')" v-if="sorting.summary == 'descending'" :size="16" class="opacity-50 hover:opacity-100" />
        </div>
        <div class="flex flex-none justify-between items-center px-[.8em] border-b w-[6em] h-[1.8em] text-right">
            <p class="text-white/50">Point</p>
            <ChevronsUpDown @click="$emit('updateFilter', 'point', 'ascending')" v-if="sorting.point == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronUp @click="$emit('updateFilter', 'point', 'descending')" v-if="sorting.point == 'ascending'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronDown @click="$emit('updateFilter', 'point', 'default')" v-if="sorting.point == 'descending'" :size="16" class="opacity-50 hover:opacity-100" />
        </div>
        <div class="flex flex-none justify-between items-center px-[.8em] border-b w-[8em] h-[1.8em]">
            <p class="text-white/50">Status</p>
            <ChevronsUpDown @click="$emit('updateFilter', 'status_id', 'ascending')" v-if="sorting.status_id == 'default'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronUp @click="$emit('updateFilter', 'status_id', 'descending')" v-if="sorting.status_id == 'ascending'" :size="16" class="opacity-50 hover:opacity-100" />
            <ChevronDown @click="$emit('updateFilter', 'status_id', 'default')" v-if="sorting.status_id == 'descending'" :size="16" class="opacity-50 hover:opacity-100" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ChevronUp, ChevronDown, ChevronsUpDown } from "lucide-vue-next";

interface Props {
    sorting: {
        key: string,
        summary: string,
        point: string,
        status_id: string,
    }
}

defineEmits<{
    updateFilter: [column: string, order: string]
}>()

defineProps<Props>()

</script>