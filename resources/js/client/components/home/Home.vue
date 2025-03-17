<template>
    <Main :categories="categories" />
</template>

<script setup>
import Main from '../main/Main.vue';

defineProps({
    categories: Array
});
</script>

<style scoped lang="scss"></style>
