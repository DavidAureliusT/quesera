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
    <div :class="className" v-bind="$attrs" class="flex justify-center items-center rounded-md size-8 aspect-square text-sidebar-primary-foreground animate-bounce">
        <Bean :size="24" />
    </div>
</template>