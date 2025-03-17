<template>
    <div>
        <h1 v-if="private">Private Product</h1>
        <h1 v-else>Product Category: {{ category.title }}</h1>
        <div class="filters flex items-center justify-self-start gap-4">
            <p>Filter:</p>
            <div class="w-full max-w-sm min-w-[200px]">
                <div class="relative">
                    <select
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                        <option value="brazil">Brazil</option>
                        <option value="bucharest">Bucharest</option>
                        <option value="london">London</option>
                        <option value="washington">Washington</option>
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                </div>
            </div>
            <div class="w-full max-w-sm min-w-[200px]">
                <div class="relative">
                    <select
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                        <option value="brazil">Brazil</option>
                        <option value="bucharest">Bucharest</option>
                        <option value="london">London</option>
                        <option value="washington">Washington</option>
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                </div>
            </div>
        </div>
        <ul>
            <li v-for="product in products" :key="product.id">
                <h3>{{ product.title }}</h3>
                <p v-html="product.description"></p>
                <p>Price: {{ product.price }}$</p>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
    private: Boolean,
    category: Object,
    products: Array
});
</script>
<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/typography.scss";
@use "../../../../assets/styles/shared.scss";
</style>
