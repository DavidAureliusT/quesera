<template>
    <input id="shortcut" type="text" v-model="keyTypeHistory" @keydown="handleKeyPress" @keyup="handleKeyUp" :autofocus="true" placeholder="Type anything" class="bg-transparent px-[.8em] w-full h-0">
</template>

<script setup lang="ts">
import { QueseraKeyboardEvent } from "@/types";
import { ref, reactive, Reactive, onMounted, onUnmounted, watchEffect } from "vue";

import { useLeftPanelStatus } from "@/composables/useLeftPanelStatus";
import { useRightPanelStatus } from "@/composables/useRightPanelStatus";

const { leftPanelStatus, updateLeftPanelStatus } = useLeftPanelStatus();
const { rightPanelStatus, updateRightPanelStatus } = useRightPanelStatus();

const hotKeyActions = [
    { key: '[', action: 'toggleLeftPanel' },
    { key: ']', action: 'toggleRightPanel' },
    { key: '\\', action: 'toggleBottomPanel' },
]

const isFocused = ref<boolean>(false);
const focusId = ref<string>('');
const keyTypeHistory = ref<string>('');


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

watchEffect(() => {
    if (!isFocused.value) _reFocusToShortcut()

    if (keyTypeHistory.value.length == 5) {
        keyTypeHistory.value = keyTypeHistory.value.slice(-4);
    }
});


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

function checkInputFocus() {
    const el = document.activeElement
    isFocused.value = el!.tagName === 'INPUT'
    focusId.value = el!.id;
}

function _reFocusToShortcut() {
    const interval = setInterval(function () {
        if (!isFocused.value) {
            _focusInputById('shortcut');
        }
        clearInterval(interval)
    }, (1 * 1000));
    console.log("_reFocusToShortcut()")
}

function _focusInputById(id: string) {
    console.log('_focusInputById(' + id + ')')
    const el = document.getElementById(id) as HTMLInputElement | null
    el?.focus()
}

function _keyboardListenerHandle(event: KeyboardEvent) {
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

function handleKeyPress(event: KeyboardEvent) {
    _keyboardListenerHandle(event);
    hotKeyActions.find((hotkey) => {
        if (hotkey.key == event.key) {
            console.log('hot key action: ' + hotkey.action);
            if (hotkey.action == 'toggleLeftPanel') {
                if (leftPanelStatus.value == 'open') {
                    updateLeftPanelStatus('close');
                } else {
                    updateLeftPanelStatus('open');
                }
            };
            if (hotkey.action == 'toggleRightPanel') {
                if (rightPanelStatus.value == 'open') {
                    updateRightPanelStatus('close');
                } else {
                    updateRightPanelStatus('open');
                }
            };
            return true;
        }
    });
}

function handleKeyUp() {
    const interval = setInterval(() => {
        keyTypeHistory.value = ''
        clearInterval(interval);
    }, 1 * 1000);
}

</script>