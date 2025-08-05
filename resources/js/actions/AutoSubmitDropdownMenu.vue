<script setup lang="ts">
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuRadioGroup,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

import { type HTMLAttributes } from 'vue'
import { useForm } from "@inertiajs/vue3";
import { useToast } from '@/components/ui/toast/use-toast';

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
    placeholder?: string,
}
const props = defineProps<Props>()

const form = useForm({
    [props.attributeName]: props.inputValue
})

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
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <slot name="trigger" />
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-48">
            <DropdownMenuRadioGroup v-model="form[attributeName]" v-on:vue:updated="postSubmit">
                <slot name="dropdown-menu-radio-items" />
            </DropdownMenuRadioGroup>
        </DropdownMenuContent>
    </DropdownMenu>
</template>