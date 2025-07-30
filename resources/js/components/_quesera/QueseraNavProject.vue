<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import QueseraNavItemProject from './QueseraNavItemProject.vue';
import QueseraNavProjectTopBar from './QueseraNavProjectTopBar.vue';

const page = usePage();

</script>

<template>
    <div class="flex flex-col">
        <QueseraNavProjectTopBar />
        <div class="h-[calc(100vh-(3*1.8em))] overflow-y-scroll">
            <QueseraNavItemProject v-for="(item, index) in page.props.compas.projectItems.myProjects" :key="index" :item="item" />
        </div>
    </div>
</template>