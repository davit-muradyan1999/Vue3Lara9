<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    collections: Array,
});
const locale = computed(() => usePage().props.locale)
</script>

<template>
    <div>
        <h1>Collections</h1>
        <ul>
            <li v-for="collection in collections" :key="collection.id">
<!--                <img :src="" alt="Collection Image" width="100" />-->
                <span>{{ collection.name }}</span>
            </li>
        </ul>
    </div>
</template>

<style scoped lang="scss">

</style>
