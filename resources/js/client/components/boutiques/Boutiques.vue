<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    boutiques: Array,
});
const locale = computed(() => usePage().props.locale)
</script>

<template>
    <div>
        <h1>Boutiques</h1>
        <ul>
            <li v-for="item in boutiques" :key="item.id">
                <!--                <img :src="" alt="Collection Image" width="100" />-->
                <span>{{ item.title[locale] }}</span>
                <p v-html="item.description[locale]"></p>
                <img :src="'storage/' + item?.image">
            </li>
        </ul>
    </div>
</template>

<style scoped lang="scss">
img{
    width: 100%;
}
</style>
