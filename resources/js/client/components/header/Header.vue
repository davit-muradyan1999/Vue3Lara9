<template>
    <div>
      <header class="app__header">
        <div class="app-bar">
          <div class="app-bar__wrapper">
            <a class="link--plain link-icon--expandOnHover app-bar__cart" href="/react-based-shopify-craft-theme/cart">
              <img src="/public/client/icons/bascet.svg" alt="bascet">
              <span class="badge link-icon__badge">0</span></a>
              <a aria-current="page" class="link--plain app-bar__company active" href="/">
                  <img class="icon logo link-icon__icon" src="/public/client/icons/logo.svg"  alt="logo">
              </a>
            <button type="button" class="button--plain  button-icon--expandOnHover  app-bar__search">
                <img src="/public/client/icons/search.svg" alt="search">
            </button>
            <button type="button" class="button--plain  button-icon--expandOnHover  app-bar__menu">
                <img src="/public/client/icons/burger.svg" alt="burger">
            </button>
          </div>
        </div>
        <nav class="nav-bar">
          <menu class="menu-list--metro nav-bar__menu">
            <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/">Home</Link></li>
            <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/about">About</Link></li>
            <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/collections">Collections</Link></li>
            <DropdownMenu />
            <li class="menu-list__item"><a @click.prevent="openPopup" class="link--underlineOnHover menu-list__link" href="#">Authenticity check</a></li>
            <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/private-club">Private club</Link></li>
            <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/boutiques">Boutiques</Link></li>
            <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/blogs">Blog</Link></li>
            <SearchPopup ref="searchPopup" />
          </menu>
        </nav>
      </header>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import DropdownMenu from './DropdownMenu.vue';
import SearchPopup from '../searchPopup/SearchPopup.vue';
import { Link } from '@inertiajs/vue3';

const searchPopup = ref(null);

const openPopup = () => {
  searchPopup.value.openPopup();
};
</script>
<style lang="scss" scoped>
.logo{
    width: 100%;
    height: 100%;
  }
  .badge {
      border-radius: .5rem;
      box-sizing: border-box;
      color: #f4f4f4;
      display: inline-block;
      font-size: .625rem;
      height: 1rem;
      line-height: 1.187rem;
      min-width: 1rem;
      padding: 0 .25rem;
      text-align: center;
      background-color: #212121;
  }
</style>
