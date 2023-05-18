<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pins
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-xl">Detail your pins</h1>
                <div class="">
                    <!-- Insert Code here -->
                    <div class="mt-2">
                        <InputLabel for="pinTitle" value="Title" />
                        <TextInput id="pinTitle" type="text" class="mt-1 bg-gray-100 block w-full" disabled
                            :value="pin[0].title" />
                    </div>

                    <div class="mt-2">
                        <InputLabel for="pinDescription" value="Description" />
                        <textarea id="pinDescription" rows="4"
                            class="bg-gray-100 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-1"
                            placeholder="Describe your pin" disabled :value="pin[0].description"></textarea>
                    </div>

                    <div class="mt-2">
                        <InputLabel for="pinUser" value="User" />
                        <TextInput id="pinUser" type="text" class="mt-1 bg-gray-100 block w-full" disabled
                            :value="pin[0].user_name" />
                    </div>

                    <div class="mt-2">
                        <InputLabel for="pinCreatedAt" value="Created At" />
                        <TextInput id="pinCreatedAt" type="text" class="mt-1 bg-gray-100 block w-full" disabled
                            :value="pin[0].created_at" />
                    </div>

                    <div class="mt-2">
                        <InputLabel for="pinUpdatedAt" value="Updated At" />
                        <TextInput id="pinUpdatedAt" type="text" class="mt-1 bg-gray-100 block w-full" disabled
                            :value="pin[0].updated_at" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4">
                            <Link :href="route('pin.destroy')" method="post" :data="{ id: pin.id }">Delete</Link>
                        </PrimaryButton>
                        <PrimaryButton class="ml-4">
                            <Link :href="route('pin.edit')" method="get" :data="{ id: pin[0].id }">Edit</Link>
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    pin: {
        Type: Object,
        default: () => { }

    },
    components: {
        AppLayout,
        Welcome
    }
});




</script>

