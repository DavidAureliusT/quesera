<script setup lang="ts">
import { ref, computed } from 'vue';
import { Project, ProjectLink, type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';

import { BookOpen, Folder, Rocket } from 'lucide-vue-next';

import AppLogo from '@/components/AppLogo.vue';
import AppShell from '@/components/AppShell.vue';
import NavProject from '@/components/NavProject.vue';
import NavUser from '@/components/NavUser.vue';
import NavFooter from '@/components/NavFooter.vue';

import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';

import {
    ResizableHandle,
    ResizablePanel,
    ResizablePanelGroup,
} from '@/components/ui/resizable';


const sidePeekObject = ref();

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];

interface Props {
    projects: Project[]
}

const props = defineProps<Props>()

const projectLinks = computed(() =>
    props.projects.map(
        (project: Project): ProjectLink => {
            return {
                title: project.name,
                href: '/projects/' + project.key,
                icon: Rocket,
            }
        }
    ));

</script>

<template>
    <AppShell variant="sidebar">
        <Sidebar collapsible="icon" variant="inset">

            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" as-child>
                            <Link :href="route('home')">
                            <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavProject :links="projectLinks" />
                <NavProject :links="projectLinks" />
                <NavProject :links="projectLinks" />
                <NavProject :links="projectLinks" />
                <NavProject :links="projectLinks" />
                <NavProject :links="projectLinks" />
                <slot name="navigation" />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter :items="footerNavItems" />
                <NavUser />
            </SidebarFooter>

        </Sidebar>
        <ResizablePanelGroup direction="horizontal">

            <ResizablePanel>
                <pre>{{ props.projects }}</pre>
            </ResizablePanel>

            <ResizableHandle v-if="sidePeekObject" />

            <ResizablePanel v-if="sidePeekObject" :default-size="35" :min-size="35" :max-size="35">
                <slot name="secondary" />
            </ResizablePanel>

        </ResizablePanelGroup>
    </AppShell>
</template>