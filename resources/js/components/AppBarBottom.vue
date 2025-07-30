<script setup lang="ts">
import NavUser from '@/actions/NavUser.vue';
import HiddenShortcut from './HiddenShortcut.vue';
</script>

<template>
    <div class="flex-1 bg-neutral-900 border-t">
        <div class="flex">
            <div class="flex-1 text-center">
                <HiddenShortcut />
            </div>
            <div class="flex-1">
                <div class="flex flex-row-reverse items-center gap-[.4em]">
                    <NavUser />
                </div>
            </div>
        </div>
    </div>
</template>