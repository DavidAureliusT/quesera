<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { useToast } from '@/components/ui/toast/use-toast';
import { type HTMLAttributes, onMounted } from 'vue'
import { cn } from '@/lib/utils'

const { toast } = useToast();

interface Props {
    type: 'text' | 'number'
    method: 'post' | 'put',
    url: string,
    attributeName: string,
    title: string,
    inputValue?: any,
    class?: HTMLAttributes['class'],
    useReset?: boolean,
    useFocus?: boolean,
    placeholder?: string,
}
const props = defineProps<Props>()

const emit = defineEmits<{
    onBlur: []
}>()

const form = useForm({
    [props.attributeName]: props.inputValue
})

onMounted(() => {
    if (props.useFocus) {
        _focusInputById(props.attributeName + '-input')
    }
})

function _focusInputById(id: string) {
    const el = document.getElementById(id) as HTMLInputElement | null
    el?.focus()
}

const blurActiveElement = () => {
    const activeElement = document.activeElement;
    if (activeElement instanceof HTMLElement) {
        activeElement.blur();
    }
}

const submit = () => {
    emit('onBlur');
    if (form.isDirty) {
        form.submit(props.method, props.url, {
            onSuccess: () => {
                toast({
                    title: props.title,
                    description: JSON.stringify(form.data()),
                });
                if (props.useReset) form.reset();
            }
        });
    }
}

</script>

<template>
    <form @submit.prevent="blurActiveElement">
        <input :id="attributeName + '-input'" :type="type" v-model="form[attributeName]" @blur="submit" :class="cn('leading-0 w-full', props.class)" :placeholder="placeholder">
        <input type="submit" hidden />
    </form>
</template>