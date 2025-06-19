<script setup lang="ts">
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type ProjectLink } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
    links: ProjectLink[];
}>();

const page = usePage();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Projects</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem v-for="link in links" :key="link.name">
                <SidebarMenuButton as-child :is-active="link.href === page.url" :tooltip="link.name">
                    <Link :href="link.href">
                    <component :is="link.icon" />
                    <span>{{ link.name }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>