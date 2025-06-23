<script setup lang="ts">
import { ref, computed } from 'vue';
import { Project, ProjectItem, type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

import { BookOpen, Folder, Rocket } from 'lucide-vue-next';

import AppLogo from '@/components/AppLogo.vue';
import AppShell from '@/components/AppShell.vue';
import NavMain from '@/components/NavMain.vue';
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

interface Props {
    project?: Project
}

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

const props = defineProps<Props>()

const page = usePage();

const projectNavItems = computed(() =>
    page.props.compas.projectItems.map(
        (project: ProjectItem): NavItem => {
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
                <NavMain :items="projectNavItems" />
                <slot name="navigation" />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter :items="footerNavItems" />
                <NavUser />
            </SidebarFooter>

        </Sidebar>
        <ResizablePanelGroup direction="horizontal">

            <ResizablePanel>
                <pre v-if="!props.project">{{ page.props.compas.projectItems }}</pre>
                <pre v-else>{{ props.project }}</pre>
            </ResizablePanel>

            <ResizableHandle v-if="sidePeekObject" />

            <ResizablePanel v-if="sidePeekObject" :default-size="35" :min-size="35" :max-size="35">
                <slot name="secondary" />
            </ResizablePanel>

        </ResizablePanelGroup>
    </AppShell>
</template>