<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { useToast } from '@/components/ui/toast/use-toast';
import { type HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'

const { toast } = useToast();

interface Props {
    type: 'text' | 'number'
    class?: HTMLAttributes['class'],
    url: string,
    attributeName: string,
    inputValue: any,
    title: string,
}
const props = defineProps<Props>()

const form = useForm({
    [props.attributeName]: props.inputValue
})


const blurActiveElement = () => {
    const activeElement = document.activeElement;
    if (activeElement instanceof HTMLElement) {
        activeElement.blur();
    }
}

const postSubmit = () => {
    if (form.isDirty) {
        form.put(props.url, {
            onSuccess: () => {
                toast({
                    title: props.title,
                    description: JSON.stringify(form.data()),
                });
            }
        });
    }
}

</script>

<template>
    <form @submit.prevent="blurActiveElement">
        <input :type="type" v-model="form[attributeName]" @blur="postSubmit" :class="cn('leading-0 w-full', props.class)">
        <input type="submit" hidden />
    </form>
</template>