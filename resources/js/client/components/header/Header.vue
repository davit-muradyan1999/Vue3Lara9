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
              <div class="language-switcher">
                  <button
                      @click="changeLanguage('am')"
                      :class="{ active: locale === 'am' }"
                  >
                      AM
                  </button>
                  <button
                      @click="changeLanguage('en')"
                      :class="{ active: locale === 'en' }"
                  >
                      EN
                  </button>
                  <button
                      @click="changeLanguage('ru')"
                      :class="{ active: locale === 'ru' }"
                  >
                      RU
                  </button>
              </div>
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
import {computed, ref} from 'vue';
import DropdownMenu from './DropdownMenu.vue';
import SearchPopup from '../searchPopup/SearchPopup.vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const locale = computed(() => usePage().props.locale);
const searchPopup = ref(null);
const changeLanguage = (locale) => {
    console.log(
        'locale',
        locale)
    router.get(route('lang.switch', locale), {}, {
        preserveScroll: true,
    })
}
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
.language-switcher {
    display: flex;
    gap: 10px; /* Расстояние между кнопками */
}

.language-switcher button {
    padding: 6px 12px;
    background-color: #e5e7eb; /* Серый фон по умолчанию */
    color: #374151; /* Темно-серый текст */
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.2s ease;
}

.language-switcher button:hover {
    background-color: #3b82f6; /* Синий при наведении */
    color: white;
}

.language-switcher button.active {
    background-color: #2563eb; /* Более темный синий для активного языка */
    color: white;
}
</style>
