<template>
    <tr :class="{
        'bg-white text-black': !isAfterNoon,
        'text-white': isAfterNoon
    }">
        <td class="px-[1em] py-[.2em]">{{ timezone }}</td>
        <td class="px-[1em] py-[.2em] text-right">
            <p class="flex justify-between items-center tabular-nums">
                <span class="w-[2em]">
                    <Moon v-if="isAfterNoon" />
                    <Sun v-else />
                </span>
                {{ currentTime.toLocaleTimeString('EN', { timeStyle: "medium" }) }}
            </p>
        </td>
        <td class="px-[1em] py-[.2em]">{{ currentTime.toLocaleDateString('EN', { dateStyle: "full" }) }}</td>
        <td class="px-[1em] py-[.2em]">{{ timeZoneAbbr }}</td>
    </tr>
</template>

<script setup lang="ts">
import { computed } from "vue";
import { useWorldClock } from '@/composables/useWorldClock';
import { Moon, Sun } from 'lucide-vue-next';

interface Props {
    countryCode: string[],
    timezone: string
}

const props = defineProps<Props>()

const { currentTime, timeZoneAbbr } = useWorldClock(props.timezone)

const isAfterNoon = computed(() => currentTime.value.toLocaleTimeString('EN', { timeStyle: 'short' }).slice(-2) == 'PM')
</script>