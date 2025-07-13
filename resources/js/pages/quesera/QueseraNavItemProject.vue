<template>
    <Link :key="item.id" :href="item.href" class="flex flex-row hover:bg-white/20 px-[.8em] py-[.2em]" :class="classes">
    <div class="w-[3em]">
        <p class="opacity-50 font-mono text-[1.0em]">{{ item.key }}</p>
    </div>
    <div class="flex-1">
        <p class="text-[1.0em]">{{ item.name }}</p>
    </div>
    </Link>
</template>

<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { computed, Ref } from "vue";
import { NavItemProject } from "@/types";

const page = usePage();

interface Props {
    item: NavItemProject
}

const props = defineProps<Props>();

const classes: Ref<string> = computed(() => {
    return props.item.href == page.url ? 'bg-white/10' : '';
});
</script>