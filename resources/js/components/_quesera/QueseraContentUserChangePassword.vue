<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from "vue";

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: (errors: any) => {
            if (errors.password) {
                form.reset('password', 'password_confirmation');
                if (passwordInput.value instanceof HTMLInputElement) {
                    passwordInput.value.focus();
                }
            }

            if (errors.current_password) {
                form.reset('current_password');
                if (currentPasswordInput.value instanceof HTMLInputElement) {
                    currentPasswordInput.value.focus();
                }
            }
        },
    });
};
</script>

<template>
    <div class="flex flex-col">
        <div class="flex justify-between items-center pl-[.8em] border-b h-[1.8em]">
            <p class="font-bold text-[.6em] text-white/50 uppercase">Change Password</p>
        </div>
        <div class="place-items-center grid h-[calc(100vh-(3*1.8em))]">
            <div class="w-xl">
                <p class="font-bold text-[2.4em]">Change Password</p>
                <form @submit.prevent="updatePassword" class="space-y-6">
                    <div class="gap-2 grid">
                        <Label for="current_password">Current password</Label>
                        <Input id="current_password" ref="currentPasswordInput" v-model="form.current_password" type="password" class="block mt-1 w-full" autocomplete="current-password" placeholder="Current password" />
                        <InputError :message="form.errors.current_password" />
                    </div>

                    <div class="gap-2 grid">
                        <Label for="password">New password</Label>
                        <Input id="password" ref="passwordInput" v-model="form.password" type="password" class="block mt-1 w-full" autocomplete="new-password" placeholder="New password" />
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="gap-2 grid">
                        <Label for="password_confirmation">Confirm password</Label>
                        <Input id="password_confirmation" v-model="form.password_confirmation" type="password" class="block mt-1 w-full" autocomplete="new-password" placeholder="Confirm password" />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="form.processing">Save password</Button>

                        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-show="form.recentlySuccessful" class="text-neutral-600 text-sm">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>