<template>
    <div v-if="isOpen" class="fixed inset-0 bg-black/50 z-50 flex justify-center items-center" @click.self="closeModal">
        <div class="bg-white p-6 rounded-lg w-full max-w-md popup_main">
            <h2 class="text-xl font-semibold mb-4">Request Price</h2>
            <form @submit.prevent="submitForm">
                <input v-model="form.email" type="email" placeholder="Email" required class="w-full border mb-3 p-2 rounded" />
                <input v-model="form.phone_number" type="tel" placeholder="Phone Number" required class="w-full border mb-3 p-2 rounded" />
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
                <button @click="$emit('close')" type="button" class="ml-2 text-gray-500">Cancel</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    productId: Number,
    isOpen: Boolean,
})

const emit = defineEmits(['close'])
const closeModal = () => {
    emit('close')
}
const form = useForm({
    email: '',
    phone_number: '',
    product_id: props.productId
})

const submitForm = () => {
    form.post('/request-price', {
        onSuccess: () => {
            emit('close')
        }
    })
}
</script>
<style scoped lang="scss">
.popup_main{
    padding: 2rem;
}
</style>
