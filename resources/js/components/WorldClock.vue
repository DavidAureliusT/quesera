<template>
    <div class="border border-white rounded-full min-w-[8em] aspect-square">
        <div class="place-items-center grid w-full h-full">
            <div class="flex flex-col items-center">
                <div class="flex gap-[.8em]">
                    <Moon v-if="true"></Moon>
                    <Sun v-if="true"></Sun>
                </div>
                <h3>{{ location }}</h3>
                <p class="font-mono text-[1.2em]">{{ currentTime }}</p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useWorldClock } from '@/composables/useWorldClock';
import { Moon, Sun } from 'lucide-vue-next';

interface Props {
    location: string,
    timezone: string,
}

const props = defineProps<Props>();

const { currentTime } = useWorldClock(props.timezone);
</script>

<style scoped>
.world-clock {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    text-align: center;
}
</style>