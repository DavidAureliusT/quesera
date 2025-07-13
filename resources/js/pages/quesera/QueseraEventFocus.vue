<template>
    <div class="flex flex-col">
        <div class="h-0">
            <p class="p-[.8em] font-bold text-[.6em] text-white/50 uppercase">Keyboard ({{ keyTypeHistory.length }}) {{ keyTypeHistory.slice(-4) }}</p>
            <div class="">
                <input id="shortcut" type="text" v-model="keyTypeHistory" @keydown="handleKeyPress" @keyup="handleKeyUp" :autofocus="true" placeholder="Type anything" class="px-[.8em] py-[.4em] border-b w-full">
            </div>
        </div>
        <div class="bg-black pb-[.8em] border-b">
            <p class="p-[.8em] font-bold text-[.6em] text-white/50 uppercase">Focus</p>
            <div class="mb-[.8em] pb-[.8em] border-b">
                <pre class="px-[.8em] text-[.8em]">
                    <table class="table border w-full table-fixed">
                        <tr>
                            <td class="px-[.2em] border">keyTypeHistory</td>
                            <td class="px-[.2em] border">{{ keyTypeHistory }}</td>
                        </tr>
                        <tr>
                            <td class="px-[.2em] border">isFocused</td>
                            <td class="px-[.2em] border">{{ isFocused }}</td>
                        </tr>
                        <tr>
                            <td class="px-[.2em] border">focusId</td>
                            <td class="px-[.2em] border">{{ focusId }}</td>
                        </tr>
                    </table>
                </pre>
                <pre class="px-[.8em] text-[.8em]">{{ !isFocused ? 'No Focus' : '' }}</pre>
                <pre class="px-[.8em] text-[.8em]">{{ isFocused && focusId == '' ? 'Focus to other input' : '' }}</pre>
                <pre class="px-[.8em] text-[.8em]">{{ focusId == 'shortcut' ? 'Focus to shortcut' : '' }}</pre>
            </div>
        </div>
        <div class="bg-black pb-[.8em] border-b">
            <p class="p-[.8em] font-bold text-[.6em] text-white/50 uppercase">Event Dump</p>
            <pre class="px-[.8em] text-[.8em]">{{ eventKey }}</pre>
        </div>
    </div>
</template>

<script setup lang="ts">
import {
    reactive,
    Reactive,
    ref,
    Ref,
    onMounted,
    onUnmounted,
    onUpdated,
} from "vue";

import { QueseraKeyboardEvent } from "@/types";
import { useLeftPanel } from "@/composables/_useLeftPanel";
import { useRightPanel } from "@/composables/useRightPanel";

const hotKeyActions = [
    { key: '[', action: 'toggleLeftPanel' },
    { key: ']', action: 'toggleRightPanel' },
    { key: '\\', action: 'toggleBottomPanel' },
]

const eventKey: Reactive<QueseraKeyboardEvent> = reactive({
    isComposing: false,
    code: "",
    key: "",
    location: 0,
    altKey: false,
    ctrlKey: false,
    metaKey: false,
    shiftKey: false,
    repeat: false,
});

function keyboardListenerHandle(event: KeyboardEvent) {
    eventKey.isComposing = event.isComposing;
    eventKey.code = event.code;
    eventKey.key = event.key;
    eventKey.location = event.location;
    eventKey.altKey = event.altKey;
    eventKey.ctrlKey = event.ctrlKey;
    eventKey.metaKey = event.metaKey;
    eventKey.shiftKey = event.shiftKey;
    eventKey.repeat = event.repeat;
}

const isFocused: Ref<boolean> = ref(false);
const focusId: Ref<string> = ref('');
const keyTypeHistory: Ref<string> = ref('');

function checkInputFocus() {
    const el = document.activeElement
    isFocused.value = el!.tagName === 'INPUT'
    focusId.value = el!.id;
}

function focusInputById(id: string) {
    console.log('focusInputById(' + id + ')')
    const el = document.getElementById(id) as HTMLInputElement | null
    el?.focus()
}

onMounted(() => {
    console.log("onMounted()")
    window.addEventListener('focusin', checkInputFocus);
    window.addEventListener('focusout', checkInputFocus);
});

onUnmounted(() => {
    console.log("onUnmounted()")
    window.removeEventListener('focusin', checkInputFocus);
    window.removeEventListener('focusout', checkInputFocus);
});

onUpdated(() => {
    if (!isFocused.value) reFocusToShortcut()

    if (keyTypeHistory.value.length == 5) {
        keyTypeHistory.value = keyTypeHistory.value.slice(-4);
    }
});

function reFocusToShortcut() {
    const timeout = setTimeout(function () {
        if (!isFocused.value) {
            focusInputById('shortcut');
        }
        clearTimeout(timeout)
    }, (1 * 1000));
    console.log("reFocusToShortcut()")
}

const { toggleLeftPanel } = useLeftPanel();
const { toggleRightPanel } = useRightPanel();

function handleKeyPress(event: KeyboardEvent) {
    keyboardListenerHandle(event);
    hotKeyActions.find((hotkey) => {
        if (hotkey.key == event.key) {
            console.log('hot key action: ' + hotkey.action);
            if (hotkey.action == 'toggleLeftPanel') toggleLeftPanel();
            if (hotkey.action == 'toggleRightPanel') toggleRightPanel();
            return true;
        }
    });
}

function handleKeyUp() {
    const timeout = setTimeout(() => {
        keyTypeHistory.value = ''
        clearTimeout(timeout);
    }, 1 * 1000);
}

</script>