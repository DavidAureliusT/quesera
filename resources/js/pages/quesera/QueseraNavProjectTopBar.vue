<script setup lang="ts">
import { Plus } from 'lucide-vue-next';
import QueseraFormCreateProject from './QueseraFormCreateProject.vue';
</script>

<template>
    <div class="flex justify-between items-center pl-[.8em] border-b h-[1.8em]">
        <p class="font-bold text-[.6em] text-white/50 uppercase">Projects</p>
        <QueseraFormCreateProject>
            <template #trigger>
                <div class="hover:bg-white/10 m-[.2em] p-[.2em] rounded transition-all">
                    <Plus :size="16" />
                </div>
            </template>
        </QueseraFormCreateProject>
    </div>
</template>