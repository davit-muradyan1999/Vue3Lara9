<template>
    <div>
        <h1>Your Cart</h1>
        <div v-if="items.length">
            <div v-for="item in items" :key="item.id" class="cart-item">
                <img :src="`/storage/${item.product.images[0]}`" alt="product" width="100" />
                <div>{{ item.product.title[locale] }}</div>
                <div>{{ item.product.price }} x {{ item.quantity }}</div>
                <div>Total: {{ item.product.price * item.quantity }}</div>
                <button @click="removeItem(item.id)">Remove</button>
            </div>
        </div>
        <div v-else>
            Cart is empty
        </div>
    </div>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    items: Array
})
console.log(props.items)
const locale = computed(() => usePage().props.locale)

const removeItem = (id) => {
    router.post('/cart/remove', { id }, { preserveScroll: true })
}
</script>
