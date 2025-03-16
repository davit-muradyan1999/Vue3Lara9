<script setup>
defineProps({
    boutiques: Array,
});
</script>

<template>
    <div>
        <h1>Boutiques</h1>
        <ul>
            <li v-for="item in boutiques" :key="item.id">
                <!--                <img :src="" alt="Collection Image" width="100" />-->
                <span>{{ item.title }}</span>
                <p v-html="item.description"></p>
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
