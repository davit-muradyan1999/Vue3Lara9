<template>
    <form class="max-w-sm mx-auto"  @submit.prevent="submit">
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
            <input v-model="form.email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="name@flowbite.com" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your password</label>
            <input v-model="form.password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
        </div>
        <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
                <input id="remember" type="checkbox" v-model="form.remember"  value="" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300" required />
            </div>
            <label for="remember" class="ms-2 text-sm font-medium text-gray-900">Remember me</label>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>

</template>

<script setup>
import {router, useForm} from '@inertiajs/vue3'
import {route} from "ziggy-js";

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.post('/login', {
        onSuccess: () => {
            router.reload({ only: ['authUser'] });
        }
    })
}
</script>
