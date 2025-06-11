<template>
    <div class="flex flex-col lg:justify-center items-center bg-[#FDFDFC] dark:bg-[#0a0a0a] p-6 lg:p-8 min-h-screen">
        <div class="flex justify-center items-center opacity-100 starting:opacity-0 w-full transition-opacity duration-750 lg:grow">
            <slot />
        </div>
    </div>
</template>