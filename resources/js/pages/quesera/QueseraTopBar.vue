<template>
    <header class="flex items-center bg-blue-200/5 px-[.8em] border-b w-full h-[1.8em]">
        <TopBarSideGroup class="flex flex-row items-center gap-[.8em]">
            <Link href="/projects">
            <QueseraLogoSmall />
            </Link>
        </TopBarSideGroup>
        <TopBarCenterGroup>
            <TopBarClock :timezone="timezoneCurrent" />
            <!-- <small class="tracking-wide">Welcome, [SI-000128] David</small> -->
        </TopBarCenterGroup>
        <TopBarSideGroup class="flex flex-row-reverse items-center gap-[.4em]">
            <!-- <div class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                <Settings :size="16" />
            </div> -->
            <DropdownMenu>
                <DropdownMenuTrigger as-child>
                    <div class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                        <UserCircle :size="16" />
                    </div>
                </DropdownMenuTrigger>
                <DropdownMenuContent class="w-48">
                    <DropdownMenuLabel class="text-[.8em]">Hello, <span class="font-bold">{{ page.props.auth.user.name }}</span></DropdownMenuLabel>
                    <!-- <DropdownMenuSeparator />
                    <DropdownMenuGroup>
                        <DropdownMenuItem>
                            <span class="text-[.8em]">Edit Profile</span>
                        </DropdownMenuItem>
                        <DropdownMenuItem>
                            <span class="text-[.8em]">Change Password</span>
                        </DropdownMenuItem>
                    </DropdownMenuGroup> -->
                    <DropdownMenuSeparator />
                    <DropdownMenuItem>
                        <Link class="text-red-600" method="post" :href="route('logout')" @click="handleLogout" as="button">
                        Log out
                        </Link>
                    </DropdownMenuItem>
                </DropdownMenuContent>
            </DropdownMenu>
            <div>
                <div v-if="rightPanelStatus == 'close'" @click="updateRightPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelRight :size="16" />
                </div>
                <div v-else @click="updateRightPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelRight :size="16" class="text-orange-500" />
                </div>
            </div>
            <div>
                <div v-if="bottomPanelStatus == 'close'" @click="updateBottomPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelBottom :size="16" />
                </div>
                <div v-else @click="updateBottomPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelBottom :size="16" class="text-orange-500" />
                </div>
            </div>
            <div>
                <div v-if="leftPanelStatus == 'close'" @click="updateLeftPanelStatus('open')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelLeft :size="16" />
                </div>
                <div v-else @click="updateLeftPanelStatus('close')" class="hover:bg-white/10 my-[.2em] p-[.2em] rounded transition-all">
                    <PanelLeft :size="16" class="text-orange-500" />
                </div>
            </div>

        </TopBarSideGroup>
    </header>
</template>

<script setup lang="ts">
import { Link, usePage, router } from '@inertiajs/vue3';

import {
    PanelLeft, PanelBottom, PanelRight, UserCircle,
    // Settings
} from 'lucide-vue-next';

import QueseraLogoSmall from './QueseraLogoSmall.vue';
import TopBarSideGroup from './QueseraTopBarSideGroup.vue';
import TopBarCenterGroup from './QueseraTopBarCenterGroup.vue';
import TopBarClock from './QueseraTopBarClock.vue';
import { useLeftPanelStatus } from '@/composables/useLeftPanelStatus';
import { useRightPanelStatus } from '@/composables/useRightPanelStatus';
import { useBottomPanelStatus } from '@/composables/useBottomPanelStatus';

import {
    DropdownMenuLabel,
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
    DropdownMenuSeparator,
    DropdownMenuItem,
    // DropdownMenuGroup
} from '@/components/ui/dropdown-menu'


const timezoneCurrent = "Asia/Jakarta";

const { leftPanelStatus, updateLeftPanelStatus } = useLeftPanelStatus();
const { rightPanelStatus, updateRightPanelStatus } = useRightPanelStatus();
const { bottomPanelStatus, updateBottomPanelStatus } = useBottomPanelStatus();

const page = usePage();

const handleLogout = () => {
    router.flushAll();
};

</script>