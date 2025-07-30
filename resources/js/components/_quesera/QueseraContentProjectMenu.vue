<script setup lang="ts">
defineProps<{ selectedMenu: string }>()

const emit = defineEmits<{
    changeMenu: [menu: string]
}>()

const menus = [
    "Board",
    "List",
    "Activity Log",
    "Access",
]

function selectMenu(menu: string) {
    emit('changeMenu', menu);
}

</script>

<template>
    <div class="flex items-center gap-[1em] px-[.8em] border-y uppercase">
        <div v-for="(menu, index) in menus" :key="index" @click="selectMenu(menu)" class="hover:opacity-100 text-[.8em] cursor-pointer" :class="selectedMenu != menu ? 'opacity-40' : 'opacity-100'" v-html="menu"></div>
    </div>
</template>