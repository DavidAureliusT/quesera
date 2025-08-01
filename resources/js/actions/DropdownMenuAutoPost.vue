<script setup lang="ts">
import { type HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'
import { useForm } from "@inertiajs/vue3";
import { useToast } from '@/components/ui/toast/use-toast';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuRadioGroup,
    DropdownMenuRadioItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

const { toast } = useToast();

interface Props {
    optionItems: [],
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
            <div class="flex flex-row items-center px-[.8em] border-b w-[8em] h-[1.8em]">
                <div v-if="task.status_category == 'To do'" class="bg-white px-[.4em] py-[.3em] rounded w-fit font-bold text-[.7em] text-black uppercase leading-[1em]">{{ task.status_name }}</div>
                <div v-if="task.status_category == 'In Progress'" class="bg-process px-[.4em] py-[.3em] rounded w-fit font-bold text-[.7em] text-black uppercase leading-[1em]">{{ task.status_name }}</div>
                <div v-if="task.status_category == 'Done'" class="bg-primary px-[.4em] py-[.3em] rounded w-fit font-bold text-[.7em] text-black uppercase leading-[1em]">{{ task.status_name }}</div>
            </div>
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-48">
            <DropdownMenuRadioGroup v-model="form[attributeName]" v-on:vue:updated="postSubmit">
                <DropdownMenuRadioItem v-for="(item, index) in items" :key="index" :value="item">
                    <div class="w-fit font-bold text-[1.0em] uppercase leading-[1em]">
                        <p>{{ item }}</p>
                    </div>
                </DropdownMenuRadioItem>
            </DropdownMenuRadioGroup>
        </DropdownMenuContent>
    </DropdownMenu>
</template>