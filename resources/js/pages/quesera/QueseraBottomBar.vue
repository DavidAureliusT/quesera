<script setup lang="ts">
import QueseraBottomBarShortcut from './QueseraBottomBarShortcut.vue';
import { UserCircle } from 'lucide-vue-next';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
    DropdownMenuSeparator,
    DropdownMenuItem
} from '@/components/ui/dropdown-menu'

import { Link, usePage, router } from '@inertiajs/vue3';

const page = usePage();

const handleLogout = () => {
    router.flushAll();
};
</script>

<template>
    <div class="flex-1 bg-neutral-900 border-t">
        <div class="flex">
            <div class="flex-1 text-center">
                <QueseraBottomBarShortcut />
            </div>
            <div class="flex-1">
                <div class="flex flex-row-reverse items-center gap-[.4em]">
                    <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                            <div class="flex items-center px-[.8em] py-[.2em] rounded-l text-white/50 hover:text-primary transition-all">
                                <UserCircle :size="16" />
                                <small class="pl-[.8em] text-[.7em] uppercase leading-0 cursor-pointer">{{ page.props.auth.user.name }}</small>
                            </div>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent class="w-48" :side-offset="10">
                            <DropdownMenuItem :as-child="true">
                                <!-- :href="route('profile.edit')" -->
                                <Link class="block w-full text-[.8em]" :href="route('profile.edit')" prefetch as="button">
                                Edit Profile
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem :as-child="true">
                                <Link class="block w-full text-[.8em]" :href="route('password.edit')" as="button">
                                Change Password
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem :as-child="true">
                                <Link class="block w-full text-[.8em] text-red-600" method="post" :href="route('logout')" @click="handleLogout" as="button">
                                Log out
                                </Link>
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </div>
            </div>
        </div>
    </div>
</template>