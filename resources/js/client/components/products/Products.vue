<template>
    <div>
        <h1 v-if="private">Private Product</h1>
        <h1 v-else>Product Category: {{ category.title }}</h1>
        <div class="filters">
            <p>Filter:</p>
            <select id="small" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                <option selected>Choose a country</option>
                <option value="US">United States</option>
                <option value="CA">Canada</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
            </select>
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
