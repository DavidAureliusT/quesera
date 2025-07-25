<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { Project } from '@/types';

import QueseraShell from './quesera/QueseraShell.vue';
import QueseraContentProject from './quesera/QueseraContentProject.vue';
import QueseraContentUserProfile from './quesera/QueseraContentUserProfile.vue';
import QueseraNavProject from './quesera/QueseraNavProject.vue';
import QueseraContentUserChangePassword from './quesera/QueseraContentUserChangePassword.vue';

interface Props {
    project?: Project,
    profile?: {
        mustVerifyEmail: boolean;
        status?: string;
    },
}

defineProps<Props>();

const page = usePage();

</script>

<template>
    <QueseraShell>
        <template #rightSide>
            <QueseraNavProject />
        </template>
        <template #center v-if="project || profile || page.url === '/settings/password'">
            <QueseraContentProject v-if="project" :project="project" />
            <QueseraContentUserProfile v-if="profile" :mustVerifyEmail="profile.mustVerifyEmail" :status="profile.status" />
            <QueseraContentUserChangePassword v-if="page.url == '/settings/password'" />
        </template>
        <template #leftSide>
            <div class="flex flex-col">
                <div class="flex justify-between items-center px-[.8em] border-b h-[1.8em]">
                    <p class="font-bold text-[.6em] text-white/50 uppercase">Diagnostic</p>
                </div>
                <div class="bg-black p-[.8em] h-[calc(100vh-(3*1.8em))] overflow-y-scroll">
                    <pre>{{ page.props.compas }}</pre>
                </div>
            </div>
        </template>
    </QueseraShell>
</template>