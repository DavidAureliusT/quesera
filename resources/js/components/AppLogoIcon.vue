<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();

const page = usePage();

</script>

<template>
    <div :class="className" v-bind="$attrs" class="flex justify-center items-center bg-sidebar-primary rounded-md size-8 aspect-square text-sidebar-primary-foreground">
        <p class="fill-current font-bold text-[1.2em] text-white dark:text-black uppercase">{{ page.props.name[0] }}</p>
    </div>
</template>