<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    philosophy: Array,
});
const locale = computed(() => usePage().props.locale)
</script>

<template>
    <div class="!flex !items-center !gap-4 !my-8">
        <div class="!flex-grow !border-t !border-black"></div>
        <h1 class="uppercase !max-w-[50rem] !text-[2.125rem]">{{ philosophy?.title[locale] }}</h1>
        <div class="!flex-grow !border-t !border-black"></div>
    </div>
    <div class="flex flex-col items-center gap-4">
        <div class="relative">
            <div v-html="philosophy?.description[locale]" class=" w-full"></div>
            <img src="/public/client/images/sign.png" class="absolute !w-auto !right-0" alt="sign" style="float: right">
        </div>
    </div>
</template>

<style scoped lang="scss">
.main_blogs{
    margin-bottom: 20px;
    padding: 20px;
}
.blog_content{
    margin-left: 20px;
}
</style>
