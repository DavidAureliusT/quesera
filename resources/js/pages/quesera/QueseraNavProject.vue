<template>
    <div class="flex justify-between items-center pl-[.8em] border-b">
        <p class="font-bold text-[.8em] text-white/50 uppercase">Projects</p>
        <QueseraFormCreateProject>
            <template #trigger>
                <div class="hover:bg-white/10 m-[.2em] p-[.2em] rounded transition-all">
                    <Plus :size="16" />
                </div>
            </template>
        </QueseraFormCreateProject>
    </div>
    <QueseraNavItemProject v-for="(item, index) in page.props.compas.projectItems" :key="index" :item="item" />

</template>

<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import { Plus } from 'lucide-vue-next';
import QueseraFormCreateProject from './QueseraFormCreateProject.vue';
import QueseraNavItemProject from './QueseraNavItemProject.vue';

const page = usePage();

</script>