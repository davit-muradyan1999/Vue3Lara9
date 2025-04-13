<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    about: Array,
});

const locale = computed(() => usePage().props.locale)
</script>

<template>
    <div>
        <h1>{{ about?.title[locale] }}</h1>
        <div v-html="about?.description[locale]"></div>
        <img :src="'storage/' + about?.image">
    </div>
</template>

<style scoped lang="scss">
img{
    width: 100%;
}
</style>
