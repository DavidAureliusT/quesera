<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import NavItem from './NavItem.vue';
import ButtonCreateProject from '@/actions/ButtonCreateProject.vue';

const page = usePage();

</script>

<template>
    <div class="flex flex-col">
        <div class="flex justify-between items-center px-[.8em] border-b border-dashed h-[1.8em]">
            <p class="font-bold text-[.6em] text-white/50 uppercase">Projects</p>
            <ButtonCreateProject />
        </div>
        <div class="relative h-[calc(100vh-(3*1.8em))] overflow-y-scroll">
            <div v-if="page.props.compas.projectItems.myProjects.length">
                <NavItem v-for="(item, index) in page.props.compas.projectItems.myProjects" :key="index" :item="item" />
            </div>
            <div v-else>
                <div class="absolute inset-0 place-items-center grid">
                    <p class="text-foreground animate-pulse">No project</p>
                </div>
            </div>
        </div>
    </div>
</template>