<template>
        <div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-transparent md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-light text-gray-500" style="margin-bottom: 10px; font-size: 1.25rem">
                        {{ $t('create_account') }}
                    </h1>

                    <form class="space-y-4 md:space-y-6"  @submit.prevent="submit">
                        <div>
                            <label for="full_name" class="block mb-2 text-sm font-light text-gray-500">{{ $t('full_name') }}</label>
                            <input v-model="form.full_name" type="text" name="full_name" id="full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " :placeholder="$t('full_name')">
                            <span v-if="form.errors.full_name" class="text-red-500 text-sm mb-3">{{ form.errors.full_name }}</span>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-light text-gray-500">{{ $t('email') }}</label>
                            <input v-model="form.email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " :placeholder="$t('email')">
                            <span v-if="form.errors.email" class="text-red-500 text-sm mb-3">{{ form.errors.email }}</span>
                        </div>
                        <div>
                            <label for="phone_number" class="block mb-2 text-sm font-light text-gray-500">{{ $t('phone') }}</label>
                            <input v-model="form.phone_number" type="text" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " :placeholder="$t('phone')">
                            <span v-if="form.errors.phone_number" class="text-red-500 text-sm mb-3">{{ form.errors.phone_number }}</span>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-light text-gray-500">{{ $t('password') }}</label>
                            <input v-model="form.password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                        <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-light text-gray-500">{{ $t('confirm_password') }}</label>
                            <input v-model="form.password_confirmation" type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <span v-if="form.errors.password" class="text-red-500 text-sm mb-3">{{ form.errors.password }}</span>

                        </div>
<!--                        <div class="flex items-start">-->
<!--                            <div class="flex items-center h-5">-->
<!--                                <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">-->
<!--                            </div>-->
<!--                            <div class="ml-3 text-sm">-->
<!--                                <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>-->
<!--                            </div>-->
<!--                        </div>-->
                        <button type="submit" class="w-full mt-4 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">{{ $t('create') }}</button>
                        <p class="text-sm font-light text-gray-500 ">
                            {{ $t('already_login') }}
                            <Link href="/login" class="font-medium text-primary-600 hover:underline">{{ $t('login_here') }}</Link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
</template>

<script setup>
import {Link, router, useForm, usePage} from '@inertiajs/vue3';

const form = useForm({
    full_name: '',
    phone_number: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const submit = () => {
    form.post('/register', {
        onSuccess: () => {
            router.reload({ only: ['authUser'] });
        }
    })
}
</script>
