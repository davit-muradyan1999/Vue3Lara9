<template>
    <div v-if="!product" >
        <div class="!flex !items-center !gap-4 !my-8">
            <div class="!flex-grow !border-t !border-black"></div>
            <h1 class="text-heading-1 landing__heading">AUTHENTICITY CHECK</h1>
            <div class="!flex-grow !border-t !border-black"></div>
        </div>
        <div class="!flex !flex-col !gap-2 !items-center">
            <div>
                <p>{{ $t('search_input_heading') }}</p>
            </div>
            <div class="!max-w-lg w-full">
                <input v-model="barcode" type="text" placeholder="" class="hidden" />
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center !ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input v-model="barcode" @keyup.enter="searchProduct" type="search" id="default-search" class="block w-full !p-4 !ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" :placeholder="$t('search_input')" required />
                    <button @click="searchProduct" type="button" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ $t('search') }}</button>
                </div>
            </div>
            <div v-if="errorMessage" class="error-message">
                <p style="color: red; font-size: 15px">{{ errorMessage }}</p>
            </div>
        </div>
    </div>
    <div v-if="product">
        <div class="!flex !items-center !gap-4 !my-8">
                <div class="!flex-grow !border-t !border-black"></div>
                <h1 class="whitespace-nowrap text-heading-1 landing__heading">CERTIFICATION OF AUTHENTICITY</h1>
                <div class="!flex-grow !border-t !border-black"></div>
        </div>

        <div class="lg:flex lg:justify-between">
            <div class="lg:w-1/3 text-gray-700"  style="word-spacing: 0.2rem">
                <p>Serial No.: {{ product.barcode }}</p>
                <p v-if="product.title">Title: {{ product.title }}</p>
                <p v-if="product.item">Item: {{ product.item }}</p>
                <p v-if="product.gold">Gold: {{ product.gold }}</p>
                <p v-if="product.stone">Stone: {{ product.stone }}</p>
                <p v-if="product.silver">Silver: {{ product.silver }}</p>
                <p v-if="product.other_materials">Other Materials: {{ product.other_materials }}</p>
                <p v-if="product.price_exclusive">Price: Exclusive</p>
                <p v-if="product.handcrafted">Handcrafted</p>
                <p v-if="product.exclusive_edition">Exclusive Edition</p>
                <p class="flex gap-1">Show Product:

                    <Link :href="'/auth-check/'+product.product_id" @click="closePopup">
                        {{ product.title }}
                    </Link>
                </p>
            </div>
            <div class="!flex-grow bg-gray-700 max-w-full w-full h-[1px] !my-2 lg:max-w-[1px] lg:w-[1px] lg:h-auto lg:!my-0"></div>
            <div class="lg:w-1/2 text-gray-700">
                <p style="word-spacing: 0.2rem">
                    {{ $t('auth_check_text') }}
                </p>
                <img src="/public/client/images/sign.png" alt="sign" style="float: right">
            </div>
        </div>

    </div>
</template>
<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import axios from "axios";

const barcode = ref('');
const product = ref(null);
const errorMessage = ref('');
console.log()
const searchProduct = async () => {
    if (barcode.value.trim() === '') return;

    try {
        if (barcode.value.length < 3) {
            return;
        }
        if (!/^\d+$/.test(barcode.value)) {
            if(usePage().props.locale === 'am'){
                errorMessage.value = "Ստուգման համարը պետք է լինի թվային։";
            }else if(usePage().props.locale === 'en'){
                errorMessage.value = "The verification number must be numeric.";
            }else{
                errorMessage.value = "Проверочный номер должен быть числовым.";
            }
            return;
        }
        const response = await axios.get(`/api/authenticity-check/${barcode.value}`);
        product.value = response.data;
        errorMessage.value = '';
    } catch (error) {
        product.value = null;
        if (error.response && error.response.status === 404) {
            if(usePage().props.locale === 'am'){
                errorMessage.value = "Սերիական համարը անվավեր է։";
            }else if(usePage().props.locale === 'en'){
                errorMessage.value = "Invalid serial number.";
            }else{
                errorMessage.value = "Неверный серийный номер.";
            }
        } else {
            errorMessage.value = 'An error occurred while searching';
        }
    }
};
</script>
<style scoped>
.text-heading {
    letter-spacing: 0.0625rem;
    line-height: 1.6em;
    font-weight: 400;
    color: #212121;
    margin-bottom: 2rem;
}


.text-heading-1 {
    font-size: 2.125rem;
}
.landing__heading {
    text-align: center;
    max-width: 50rem;
}
</style>
