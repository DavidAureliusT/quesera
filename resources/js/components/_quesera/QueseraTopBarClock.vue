<script setup lang="ts">
import { useWorldClock } from '@/composables/useWorldClock';

interface Props {
    timezone: string
}

const props = defineProps<Props>()

const { currentTime, timeZoneAbbr } = useWorldClock(props.timezone)
</script>

<template>
    <small class="p-[.8em] tracking-wide">
        [{{ timeZoneAbbr }}] ({{ timezone }}) {{ currentTime.toLocaleTimeString('EN', { timeStyle: "medium" }) }}, {{ currentTime.toLocaleDateString('EN', { dateStyle: "full" }) }}
    </small>
</template>