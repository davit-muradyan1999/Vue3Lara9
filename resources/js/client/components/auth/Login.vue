<template>

    <div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-transparent md:mt-0 sm:max-w-md xl:p-0">
            <div v-if="Object.keys(form.errors).length" class="text-red-500 text-sm mb-3">
                <ul>
                    <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
                </ul>
            </div>
            <form class="max-w-sm mx-auto"  @submit.prevent="submit">
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-light text-gray-500">{{ $t('email') }}</label>
                    <input v-model="form.email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " :placeholder="$t('email')" required />
                </div>
                <div class="mb-5" style="margin-bottom: 10px">
                    <label for="password" class="block mb-2 text-sm font-light text-gray-500">{{ $t('password') }}</label>
                    <input v-model="form.password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                </div>
                <div class="flex items-start mb-5" style="margin-bottom: 10px">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" v-model="form.remember"  value="" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-light text-gray-500">{{ $t('remember') }}</label>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ $t('login') }}</button>
            </form>
        </div>
    </div>
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
