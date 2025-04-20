<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    blogs: Array,
});
const locale = computed(() => usePage().props.locale)
</script>

<template>
<!--    <div>-->
<!--        <h1>Blogs</h1>-->
<!--        <ul>-->
<!--            <li v-for="item in blogs" :key="item.id">-->
<!--                &lt;!&ndash;                <img :src="" alt="Collection Image" width="100" />&ndash;&gt;-->
<!--                <span>{{ item.title[locale] }}</span>-->
<!--                <p v-html="item.description[locale]"></p>-->
<!--                <img :src="'storage/' + item?.image">-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
    <div class="w-full ">
        <div v-for="item in blogs" :key="item.id" class="main_blogs flex flex-col w-full items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100">
            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" :src="'storage/' + item?.image" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal blog_content">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ item.title[locale] }}</h5>
                <p class="mb-3 font-normal text-gray-700" v-html="item.description[locale]"></p>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.main_blogs{
    margin-bottom: 20px;
}
.blog_content{
    margin-left: 20px;
}
</style>
