<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    about: Array,
});

const locale = computed(() => usePage().props.locale)
</script>

<template>
    <div class="flex flex-col items-center gap-4">
        <p>{{ about?.title[locale] }}</p>
        <div v-html="about?.description[locale]"></div>
        <img class="rounded-2xl" :src="'storage/' + about?.image">
    </div>
</template>

<style scoped lang="scss">
p{
    font-size: 1.5rem;
}
img{
    width: 100%;
}
</style>
