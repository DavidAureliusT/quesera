<script setup lang="ts">
import { ref } from "vue";
import { router, usePage } from '@inertiajs/vue3'
import { Project } from '@/types';
import { Button } from "@/components/ui/button";
import BadgeStatus from '@/components/entities/tasks/BadgeStatus.vue';
import { useToast } from '@/components/ui/toast/use-toast';

interface Props {
    project: Project
}

const props = defineProps<Props>();

const page = usePage();

const { toast } = useToast();

const showOverlay = ref(false);

const submitLinking = () => {
    router.visit(route('sandbox.linking', { project_key: props.project.key }), {
        onSuccess: () => {
            toast({
                title: 'Linking Task Card',
                description: 'Linking Success',
            });
        }
    })
}

const handleCardOnDragStart = () => {
    showOverlay.value = !showOverlay.value;
}
const handleCardOnDragEnd = (e: DragEvent) => {
    e.preventDefault();
    showOverlay.value = !showOverlay.value;
    clearAllIndicator();
}

const handleCardOnDragOverHeadOverlay = (e: DragEvent, workflow_id: string) => {
    e.preventDefault();
    const indicatorElement = document.getElementById(workflow_id + '-head-indicator');
    if (indicatorElement instanceof Element) indicatorElement.classList.add('active-indicator');
    console.log(workflow_id + '-head-indicator');
}
const handleCardOnDragOverNextOverlay = (e: DragEvent, workflow_id: string, task_key: string) => {
    e.preventDefault();
    const indicatorElement = document.getElementById(workflow_id + '-next-' + task_key + '-indicator');
    if (indicatorElement instanceof Element) indicatorElement.classList.add('active-indicator');
    console.log(workflow_id + '-next-' + task_key + '-indicator');
}
const handleCardOnDragLeaveOverlay = (e: DragEvent) => {
    e.preventDefault();
    clearAllIndicator();
}

const clearAllIndicator = () => {
    const indicatorElement = document.getElementsByClassName('active-indicator');
    const indicatorElementArray = Array.from(indicatorElement);
    indicatorElementArray.forEach(element => {
        element.classList.remove('active-indicator');
    });
}

</script>

<template>
    <div class="flex flex-nowrap bg-neutral-900/50 w-[100vw] h-[100vh] overflow-scroll">
        <div class="flex w-full">
            <div class="border-r w-[20em] overflow-y-scroll">
                <pre>{{ project }}</pre>
            </div>
            <div class="flex-1 overflow-x-auto">
                <div class="flex h-full">
                    <div v-for="workflow in project.workflows" :key="workflow.id" class="flex flex-col h-full">
                        <!-- Badge Status for Kanban Column -->
                        <div class="flex items-center gap-2 px-2 h-[3em]">
                            <BadgeStatus :status_category="workflow.category" :status_name="workflow.name" /> {{ workflow.tasks!.length }}
                        </div>

                        <!-- Kanban Column -->
                        <div class="relative flex flex-col gap-[.3em] p-[.4em] border w-[320px] h-full">

                            <!-- Head Indicator -->
                            <div :id="workflow.id + '-head-indicator'" class="mt-[.3em] rounded-[10pt] h-[.2em]"></div>

                            <!-- Task Card -->
                            <div v-for="(task, index) in workflow.tasks" :key="index" draggable="true" @dragstart="handleCardOnDragStart" @dragend="handleCardOnDragEnd">
                                <div class="bg-black border rounded-[5pt] h-[130px] overflow-clip">
                                    <div class="flex flex-col justify-between p-[1.2em] h-full">
                                        <BadgeStatus :status_category="workflow.category" :status_name="workflow.name" />
                                        <div class="flex flex-col gap-[.6em]">
                                            <p class="leading-[1.2em]">{{ task.key }} - {{ task.summary }}</p>
                                            <div class="flex justify-between">
                                                <div class="flex flex-row items-start gap-[.2em] text-neutral-300">
                                                    <p class="text-[.8em] leading-[.8em]">{{ String(task.point).padStart(2, '0') }}</p>
                                                    <p class="text-[.6em] leading-[.8em]">Point(s)</p>
                                                </div>
                                                <div class="flex items-center gap-[.4em] text-[.6em]">
                                                    <div class="place-items-center grid bg-foreground rounded-full w-[1.8em] aspect-square font-medium text-black uppercase">{{ page.props.auth.user.name.slice(0, 2) }}</div>
                                                    <div class="">{{ page.props.auth.user.name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Next Task Indicator -->
                                <div :id="workflow.id + '-next-' + task.key + '-indicator'" class="mt-[.3em] rounded-[10pt] h-[.2em]"></div>

                            </div>

                            <!-- Overlay -->
                            <div class="absolute inset-0" :class="{ '-z-10': !showOverlay, 'z-20': showOverlay }">
                                <div class="flex flex-col h-full overflow-y-scroll">
                                    <div class="bg-primary/5 border-y" :class="{
                                        'flex-1': workflow.tasks!.length == 0,
                                        'h-[calc(60px+1.0em)]': workflow.tasks!.length != 0,
                                    }" @dragover="(e) => handleCardOnDragOverHeadOverlay(e, workflow.id)" @dragleave="(e) => handleCardOnDragLeaveOverlay(e)"></div>
                                    <div v-for="(task, index) in workflow.tasks" :key="index" class="p-[1.8em] border-y font-black" :class="{
                                        'bg-red-500/5 h-[calc(130px+.8em)] flex-none': index < workflow.tasks!.length - 1,
                                        'flex-1 bg-blue-900/50 ': index == workflow.tasks!.length - 1,
                                    }" @dragover="(e) => handleCardOnDragOverNextOverlay(e, workflow.id, task.key)" @dragleave="(e) => handleCardOnDragLeaveOverlay(e)">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="py-[10px] border-l w-[20em] overflow-y-scroll">
                <div class="flex gap-4 p-[10px]">
                    <p>01.</p>
                    <Button size="sm" @click="submitLinking">Linking</Button>
                </div>
                <div class="flex gap-4 p-[10px]">
                    <p>02.</p>
                    <Button size="sm" @click="() => showOverlay = !showOverlay">Toggle Overlay : {{ showOverlay }}</Button>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.active-indicator {
    background-color: var(--color-primary);
}
</style>