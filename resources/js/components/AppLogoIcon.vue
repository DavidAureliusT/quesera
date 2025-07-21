<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { Bean } from "lucide-vue-next";

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();

</script>

<template>
    <div :class="className" v-bind="$attrs" class="flex justify-center items-center rounded-md aspect-square text-sidebar-primary-foreground">
        <Bean :size="24" class="text-primary" />
    </div>
</template>