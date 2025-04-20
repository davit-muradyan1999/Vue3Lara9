<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    boutiques: Array,
});
const locale = computed(() => usePage().props.locale)
</script>

<template>
    <div class="flex flex-col items-center gap-4">
        <p class="first_p">Boutiques</p>
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
