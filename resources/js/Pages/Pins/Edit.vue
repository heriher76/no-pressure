<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pins
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-xl">Edit your pins</h1>
                <div class="">
                    <!-- Insert Code here -->
                    <form @submit.prevent="submit">
                        <Input id="pinId" :value="form.pinId = pin[0].id" type="hidden" />
                        <div class="mt-2">
                            <InputLabel for="pinTitle" value="Title" />
                            <TextInput id="pinTitle" v-model.value="pin[0].title" v-model="form.pinTitle" type="text"
                                class="mt-1 block w-full" placeholder="Pin Title" required />
                            <InputError class="mt-2" :message="form.errors.text" />
                        </div>

                        <div class="mt-2">
                            <InputLabel for="pinDescription" value="Description" />
                            <textarea id="pinDescription" v-model="form.pinDescription" rows="4"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-1"
                                placeholder="Describe your pin" v-model.text="pin[0].description" required></textarea>
                            <InputError class="mt-2" :message="form.errors.textarea" />
                        </div>

                        <div class="mt-2">
                            <InputLabel for="pinUser" value="User" />
                            <TextInput id="pinUser" v-model="form.pinUser" type="text" class="mt-1 bg-gray-100 block w-full"
                                disabled :value="pin[0].user_name" />
                            <InputError class="mt-2" :message="form.errors.text" />
                        </div>

                        <div class="mt-2">
                            <InputLabel for="pinCreatedAt" value="Created At" />
                            <TextInput id="pinCreatedAt" v-model="form.pinCreateAt" type="text"
                                class="mt-1 bg-gray-100 block w-full" disabled :value="pin[0].created_at" />
                            <InputError class="mt-2" :message="form.errors.text" />
                        </div>

                        <div class="mt-2">
                            <InputLabel for="pinUpdatedAt" value="Updated At" />
                            <TextInput id="pinUpdatedAt" v-model="form.pinCreateAt" type="text"
                                class="mt-1 bg-gray-100 block w-full" disabled :value="pin[0].updated_at" />
                            <InputError class="mt-2" :message="form.errors.text" />
                        </div>
                        <div class="flex items-center justify-end mt-4">

                            <Link :href="route('pins')">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">Cancel</PrimaryButton>
                            </Link>

                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Update
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


defineProps({
    pin: {
        Type: Object,
        default: () => { }
    },
    components: {
        AppLayout,
        Welcome
    }
});

const form = useForm({
    pinId: '',
    pinTitle: '',
    pinDescription: '',
});


const submit = () => {
    form.post(route('pin.update'));
};
</script>

