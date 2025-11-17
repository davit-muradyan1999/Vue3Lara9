<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    boutiques: Array,
});
const locale = computed(() => usePage().props.locale)
</script>

<template>
    <div class="!flex !items-center !gap-4 !my-8">
        <div class="!flex-grow !border-t !border-black"></div>
        <h1 class="uppercase !max-w-[50rem] !text-[2.125rem]">Boutiques</h1>
        <div class="!flex-grow !border-t !border-black"></div>
    </div>
    <div class="flex flex-col items-center gap-4">
        <ul>
            <li v-for="item in boutiques" :key="item.id">
                <span>{{ item.title[locale] }}</span>
                <p class="second_p" v-html="item.description[locale]"></p>
                <img class="rounded-2xl" :src="'storage/' + item?.image">
            </li>
        </ul>
    </div>
</template>

<style scoped lang="scss">
img{
    width: 100%;
}
.first_p{
    font-size: 1.5rem;
}
.second_p{
    font-size: 1.2rem;
}
span{
    font-size: 1.5rem;
}
</style>
