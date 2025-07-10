<template>
    <div class="p-[.8em]">
        <label>Shortcut</label>
        <input id="shortcut" type="text" @keydown="keyboardListenerHandle" class="p-[.8em] border rounded w-full">
        <pre class="text-[.8em]">{{ eventKey }}</pre>
    </div>
</template>

<script setup lang="ts">
import { reactive, Reactive } from "vue";
import { QueseraKeyboardEvent } from "@/types";

const eventKey: Reactive<QueseraKeyboardEvent> = reactive(
    {
        isComposing: false,
        code: "",
        key: "",
        location: 0,
        altKey: false,
        ctrlKey: false,
        metaKey: false,
        shiftKey: false,
        repeat: false,
    }
);

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

</script>