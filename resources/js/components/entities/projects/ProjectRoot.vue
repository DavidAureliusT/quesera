<script setup lang="ts">
import { inject, ref } from 'vue';
import { Project } from '@/types';
import ProjectBarTop from './ProjectBarTop.vue';
import ProjectHeader from './ProjectHeader.vue';
import EmptyState from '@/components/EmptyState.vue';
import ProjectTabs from './ProjectTabs.vue';
import ProjectTabsList from './ProjectTabsList.vue';
import ProjectList from './ProjectList.vue';
import ProjectTabsListItem from './ProjectTabsListItem.vue';
import ProjectTabsContent from './ProjectTabsContent.vue';
import ProjectKanban from './ProjectKanban.vue';

const project = inject<Project>('shared_project');

const views: Record<string, any> = {
    'LIST': ProjectList,
    'KANBAN': ProjectKanban,
}

const activeView = ref<string>('LIST');

</script>

<template>
    <div v-if="project">
        <ProjectBarTop :project_type="project!.type" />
        <ProjectHeader class="h-[calc(3*1.8em)]" :project="project!" />
        <ProjectTabs>
            <ProjectTabsList class="h-[1.8em]">
                <ProjectTabsListItem v-for="(_, key) of views" :key="key" :title="key" @click="() => activeView = key" :is-active="key == activeView" />
            </ProjectTabsList>
            <ProjectTabsContent :value="activeView" class="h-[calc(100vh-(11*1.8em))]">
                <keep-alive>
                    <component :is="views[activeView]" />
                </keep-alive>
            </ProjectTabsContent>
        </ProjectTabs>
    </div>
    <div v-else>
        <EmptyState />
    </div>
</template>