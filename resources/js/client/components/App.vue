<template>
    <Header />
    <main class="layout__main">
        <div class="layout__main-wrapper">
            <slot />
        </div>
    </main>
    <Footer />
</template>

<script setup>
import Header from './header/Header.vue';
import Footer from './footer/Footer.vue';
import Main from "./main/Main.vue";
import { usePage } from '@inertiajs/vue3';

const page = usePage().props;
console.log(page, 'page')
</script>

<style lang="scss" scoped>
@use "../../../assets/styles/colors.scss";
@use "../../../assets/styles/typography.scss";
@use "../../../assets/styles/shared.scss";
.layout__main {
    padding: 4rem 0;
}
.layout__main-wrapper {
    @extend .wrapper;
    overflow: visible;
    min-height: 100vh;
}
</style>
