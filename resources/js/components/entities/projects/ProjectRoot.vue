<script setup lang="ts">
import { ref } from 'vue';
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

defineProps<{ project?: Project, bytes?: string }>()

const views = ['LIST', 'KANBAN']

const activeView = ref<string>('KANBAN');

</script>

<template>
    <div v-if="project">
        <ProjectBarTop :project_type="project!.type" />
        <ProjectHeader class="h-[calc(3*1.8em)]" :project="project!" />
        <ProjectTabs>
            <ProjectTabsList class="h-[1.8em]">
                <ProjectTabsListItem v-for="(view, index) in views" :key="index" :title="view" @click="() => activeView = view" :is-active="view == activeView" />
            </ProjectTabsList>
            <ProjectTabsContent>
                <ProjectList v-if="activeView == 'LIST'" :project="project" />
                <ProjectKanban v-else-if="activeView == 'KANBAN'" :project="project" :bytes="bytes" />
                <div v-else class="place-items-center grid">{{ activeView }}</div>
            </ProjectTabsContent>
        </ProjectTabs>
    </div>
    <div v-else>
        <EmptyState />
    </div>
</template>