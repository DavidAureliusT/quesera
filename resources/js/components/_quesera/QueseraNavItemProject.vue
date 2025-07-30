<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { computed } from "vue";
import { NavItemProject } from "@/types";

const page = usePage();

interface Props {
    item: NavItemProject
}

const props = defineProps<Props>();

const classes = computed<string>(() => {
    const _class = 'flex flex-row items-center hover:bg-white/5 px-[.8em] py-[.2em]';
    if (props.item.href === page.url) return _class.concat(' bg-white/10');
    return _class
});
</script>

<template>
    <Link :key="item.id" :href="item.href">
    <div :class="classes">
        <div class="flex-1">
            <p>{{ item.name }}</p>
        </div>
        <div class="w-[3em]">
            <p class="opacity-50 text-[.6em] text-right">{{ item.key }}</p>
        </div>
    </div>
    </Link>
</template>