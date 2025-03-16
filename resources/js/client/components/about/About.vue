<script setup>
defineProps({
    about: Array,
});
</script>

<template>
    <div>
        <h1>{{ about?.title }}</h1>
        <div v-html="about?.description"></div>
        <img :src="'storage/' + about?.image">
    </div>
</template>

<style scoped lang="scss">
img{
    width: 100%;
}
</style>
