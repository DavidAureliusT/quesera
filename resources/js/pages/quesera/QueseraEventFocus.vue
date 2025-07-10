<template>
    <div class="flex flex-col">
        <div>
            <p class="p-[.8em] font-bold text-[.6em] text-white/50 uppercase">Keyboard</p>
            <div class="">
                <input id="shortcut" type="text" @keydown="keyboardListenerHandle" :autofocus="true" placeholder="Type anything" class="px-[.8em] py-[.4em] border-b w-full">
            </div>
        </div>
        <div class="bg-black pb-[.8em] border-b">
            <p class="p-[.8em] font-bold text-[.6em] text-white/50 uppercase">Focus</p>
            <div class="mb-[.8em] pb-[.8em] border-b">
                <pre class="px-[.8em] text-[.8em]">{{ !isFocused ? 'No Focus' : '' }}</pre>
                <pre class="px-[.8em] text-[.8em]">{{ isFocused && focusId == '' ? 'Focus to other input' : '' }}</pre>
                <pre class="px-[.8em] text-[.8em]">{{ focusId == 'shortcut' ? 'Focus to shortcut' : '' }}</pre>
            </div>
            <pre class="px-[.8em] text-[.8em]">isFocused: {{ isFocused }}</pre>
            <pre class="px-[.8em] text-[.8em]">focusId: {{ focusId }}</pre>
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
    onMounted,
    onUnmounted,
    onUpdated
} from "vue";

import { QueseraKeyboardEvent } from "@/types";

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

const isFocused = ref(false)
const focusId = ref('')

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
    // focusInputById('shortcut');
});

onUnmounted(() => {
    console.log("onUnmounted()")
    window.removeEventListener('focusin', checkInputFocus);
    window.removeEventListener('focusout', checkInputFocus);
});

onUpdated(() => {
    if (!isFocused.value) reFocusToShortcut()
});

function reFocusToShortcut() {
    const interval = setInterval(function () {
        if (!isFocused.value) {
            focusInputById('shortcut');
        }
        clearInterval(interval)
    }, (1 * 1000));
    console.log("reFocusToShortcut()")
}

</script>