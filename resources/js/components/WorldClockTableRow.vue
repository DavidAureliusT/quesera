<template>
    <td class="px-[1em] border border-gray-300 font-mono text-right">{{ currentTime }}</td>
</template>

<script setup lang="ts">
import { useWorldClock } from '@/composables/useWorldClock';

interface Props {
    timeZone: string
}

const props = defineProps<Props>()

const { currentTime } = useWorldClock(props.timeZone)
</script>