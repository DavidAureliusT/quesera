<script setup lang="ts">
import { Link, useForm, usePage } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { type User } from '@/types';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();


const page = usePage();
const user = page.props.auth.user as User;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="flex flex-col">
        <div class="flex justify-between items-center pl-[.8em] border-b h-[1.8em]">
            <p class="font-bold text-[.6em] text-white/50 uppercase">Edit Profile</p>
        </div>
        <div class="place-items-center grid h-[calc(100vh-(3*1.8em))]">
            <div class="w-xl">
                <p class="font-bold text-[2.4em]">Edit Profile</p>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="gap-2 grid">
                        <Label for="name">Name</Label>
                        <Input id="name" class="block mt-1 w-full" v-model="form.name" required autocomplete="name" placeholder="Full name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="gap-2 grid">
                        <Label for="email">Email address</Label>
                        <Input id="email" type="email" class="block mt-1 w-full" v-model="form.email" required autocomplete="username" placeholder="Email address" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="-mt-4 text-muted-foreground text-sm">
                            Your email address is unverified.
                            <Link :href="route('verification.send')" method="post" as="button" class="text-foreground decoration-neutral-300 hover:decoration-current! dark:decoration-neutral-500 underline underline-offset-4 transition-colors duration-300 ease-out">
                            Click here to resend the verification email.
                            </Link>
                        </p>

                        <div v-if="status === 'verification-link-sent'" class="mt-2 font-medium text-green-600 text-sm">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="form.processing">Save</Button>

                        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-show="form.recentlySuccessful" class="text-neutral-600 text-sm">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>