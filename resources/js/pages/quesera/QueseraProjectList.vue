<template>
    <div class="flex justify-between items-center pl-[.8em] border-b">
        <p class="font-bold text-[.6em] text-white/50 uppercase">Projects</p>
        <QueseraFormCreateProject>
            <template #trigger>
                <div class="hover:bg-white/10 m-[.2em] p-[.2em] rounded transition-all">
                    <Plus :size="16" />
                </div>
            </template>
        </QueseraFormCreateProject>
    </div>
    <QueseraProjectListItem v-for="(item, index) in page.props.compas.projectItems" :key="index" :item="item" />

</template>

<script setup lang="ts">
import { Plus } from 'lucide-vue-next';
import { usePage } from "@inertiajs/vue3";
import QueseraFormCreateProject from '@/pages/quesera/QueseraFormCreateProject.vue';
import QueseraProjectListItem from '@/pages/quesera/QueseraProjectListItem.vue';

const page = usePage();

</script>