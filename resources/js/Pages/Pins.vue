<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pins
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-xl">Create your pins</h1>
                <div class="">
                    <!-- Insert Code here -->
                    <form @submit.prevent="submit">
                        <div class="mt-2">
                            <InputLabel for="pinTitle" value="Title" />
                            <TextInput id="pinTitle" v-model="form.pinTitle" type="text" class="mt-1 block w-full"
                                placeholder="Pin Title" required autofocus />
                            <InputError class="mt-2" :message="form.errors.text" />
                        </div>

                        <div class="mt-2">
                            <InputLabel for="pinDescription" value="Description" />
                            <textarea id="pinDescription" rows="4"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-1"
                                placeholder="Describe your pin" v-model="form.pinDescription" required></textarea>
                            <InputError class="mt-2" :message="form.errors.textarea" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Add Pin
                            </PrimaryButton>
                        </div>
                    </form>


                    <div class="flex w-full container mx-auto flex-col py-10 gap-10">
                        <h1 class="text-3xl">Pins</h1>

                        <div v-for="pin in pins" :key="pin.id" class="bg-white px-5 py-2 rounded-md">
                            <h1 class="pb-5">by: <span class="font-semibold text-indigo-600">{{ pin.user_name }}</span></h1>
                            <h1 class="text-xl font-bold">{{ pin.title }}</h1>
                            <p>{{ pin.description }}</p>
                            <div class="flex items-center justify-end my-3">
                                <Link :href="route('pin.destroy')" method="post" :data="{ id: pin.id }">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">Delete</PrimaryButton>
                                </Link>
                                <Link :href="route('pin.edit')" method="get" :data="{ id: pin.id }">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">Edit</PrimaryButton>
                                </Link>

                                <Link :href="route('pin.show')" method="get" :data="{ id: pin.id }">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">Detail</PrimaryButton>
                                </Link>

                            </div>
                        </div>
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
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    pins: {
        Type: Object,
        default: () => { }
    },
    components: {
        AppLayout,
        Welcome
    }
});

const form = useForm({
    pinTitle: '',
    pinDescription: '',
});

function clearForm() {
    document.getElementById('pinTitle').value = "";
    document.getElementById('pinDescription').value = "";
};

const submit = () => {
    form.post(route('pin.store'), {
        onFinish: () => { form.reset('pinTitle', 'pinDescription'), clearForm() }
    });
};

</script>

