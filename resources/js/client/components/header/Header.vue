<template>
    <div>
        <SearchPopup ref="searchPopup" />
      <header class="app__header"
              :class="{ '!bg-[#e8e8e8] !shadow-md': scrolled }">
          <div class="flex justify-end items-center gap-2 !px-2 !py-2">
              <template v-if="!authUser">
                  <Link href="/login" class="text-sm font-bold text-blue-600">{{ $t('login') }}</Link>
                  <Link href="/register" class="text-sm font-bold text-green-600">{{ $t('register') }}</Link>
              </template>

              <template v-else>
                  <span class="text-gray-700 text-sm font-bold">{{ authUser.full_name }}</span>
                  <button @click="logout" class="text-red-600 text-sm font-bold">
                      {{ $t('logout') }}
                  </button>
              </template>
          </div>
        <div class="app-bar">
          <div class="flex app-bar__wrapper">
<!--            <Link class="link&#45;&#45;plain link-icon&#45;&#45;expandOnHover app-bar__cart" href="/cart">-->
<!--              <img src="/public/client/icons/bascet.svg" alt="bascet">-->
<!--                <span class="badge link-icon__badge" v-if="cartCount > 0">{{ cartCount }}</span>-->
<!--            </Link>-->
              <a aria-current="page" class="link--plain app-bar__company active" href="/">
                  <img class="icon logo link-icon__icon" src="/public/client/icons/logo.png"  alt="logo">
              </a>
              <button
                  type="button"
                  class="button--plain button-icon--expandOnHover app-bar__menu"
                  @click="toggleDrawer"
              >
                  <svg v-if="!isDrawerOpen" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"
                       class="icon menu button-icon__icon">
                      <path class="icon__path"
                            d="M128 554.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 298.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 810.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z"></path>
                  </svg>
                  <svg v-else version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"
                       class="icon cross button-icon__icon">
                      <path class="icon__path" d="M225.835 286.165l225.835 225.835-225.835 225.835c-16.683 16.683-16.683 43.691 0 60.331s43.691 16.683 60.331 0l225.835-225.835 225.835 225.835c16.683 16.683 43.691 16.683 60.331 0s16.683-43.691 0-60.331l-225.835-225.835 225.835-225.835c16.683-16.683 16.683-43.691 0-60.331s-43.691-16.683-60.331 0l-225.835 225.835-225.835-225.835c-16.683-16.683-43.691-16.683-60.331 0s-16.683 43.691 0 60.331z"></path>
                  </svg>
              </button>
          </div>
        </div>
        <nav class="nav-bar">
          <menu class="menu-list--metro nav-bar__menu">
            <ul>
                <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/">{{ $t('home') }}</Link></li>
                <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/about">{{ $t('about') }}</Link></li>
                <!--            <li class="menu-list__item"><Link class="link&#45;&#45;underlineOnHover menu-list__link" href="/collections">{{ $t('collections') }}</Link></li>-->
                <DropdownMenu type="collections" />
                <DropdownMenu type="category" />

                <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/auth_check">{{ $t('auth_check') }}</Link></li>
                <li v-if="authUser && authUser.is_private" class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/private-club">{{ $t('private_club') }}</Link></li>
                <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/boutiques">{{ $t('boutiques') }}</Link></li>
                <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/philosophy">{{ $t('philosophy') }}</Link></li>

            </ul>
          </menu>
        </nav>
      </header>
        <aside class="nav-drawer" :class="{ expand: isDrawerOpen }" @click="closeDrawer" style="top: 145.922px">
            <menu class="menu-list--stack nav-drawer__menu">
                    <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/">{{ $t('home') }}</Link></li>
                    <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/about">{{ $t('about') }}</Link></li>
                    <DropdownMenu type="collections" @close-drawer="closeDrawerProgrammatically" />
                    <DropdownMenu type="category" @close-drawer="closeDrawerProgrammatically" />
                    <li class="menu-list__item"><a @click.prevent="openPopup" class="link--underlineOnHover menu-list__link" href="#">{{ $t('auth_check') }}</a></li>
                    <li v-if="authUser && authUser.is_private" class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/private-club">{{ $t('private_club') }}</Link></li>
                    <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/boutiques">{{ $t('boutiques') }}</Link></li>
                    <li class="menu-list__item"><Link class="link--underlineOnHover menu-list__link" href="/blogs">{{ $t('blog') }}</Link></li>
                    <template v-if="!authUser">
                        <li class="menu-list__item"><Link href="/login" class="link--underlineOnHover menu-list__link text-blue-600">{{ $t('login') }}</Link></li>
                        <li class="menu-list__item"><Link href="/register" class="link--underlineOnHover menu-list__link text-green-600">{{ $t('register') }}</Link></li>
                    </template>

                    <template v-else>
                        <li class="menu-list__item"><span class="link--underlineOnHover menu-list__link text-gray-700">{{ authUser.full_name }}</span></li>
                        <li class="menu-list__item"><button @click="logout" class="link--underlineOnHover menu-list__link text-red-600">
                            {{ $t('logout') }}
                        </button></li>
                    </template>
            </menu>
        </aside>
    </div>
</template>
<script setup>
import {computed, onBeforeUnmount, onMounted, ref} from 'vue';
import DropdownMenu from './DropdownMenu.vue';
import SearchPopup from '../searchPopup/SearchPopup.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { i18n } from '@/i18n'

const scrolled = ref(false)
const isDrawerOpen = ref(false);
const authUser = usePage().props.auth?.user || null
const cartCount = computed(() => usePage().props.cartCount);
const locale = computed(() => usePage().props.locale);
const searchPopup = ref(null);
const selectedLanguage = ref(locale.value)
const switchLanguage = (locale) => {
    router.get(route('lang.switch', locale), {}, {
        preserveScroll: true,
        onSuccess: (page) => {
            const translations = page.props.translations
            i18n.global.setLocaleMessage(locale, translations)
            i18n.global.locale.value = locale
        }
    })
}
function logout() {
    router.post('/client/logout', {}, {
        onSuccess: () => {
            router.reload({ only: ['authUser'] });
        }
    })
}
const toggleDrawer = (event) => {
    event.stopPropagation();
    isDrawerOpen.value = !isDrawerOpen.value;
    document.body.classList.toggle('lock');
};
const closeDrawerProgrammatically = () => {
    document.body.classList.remove('lock');
    isDrawerOpen.value = false;
};
const closeDrawer = (event) => {
    if (event && event.target.closest('.dropdown-menu')) return;

    document.body.classList.remove('lock');
    isDrawerOpen.value = false;
};
const openPopup = () => {
  searchPopup.value.openPopup();
};


onMounted(() => {
    const onScroll = () => {
        scrolled.value = window.scrollY > 50 // меняй число под свой порог
    }
    window.addEventListener('scroll', onScroll)
    onScroll()
})

onBeforeUnmount(() => {
    window.removeEventListener('scroll', onScroll)
})
</script>
<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/shared.scss";
.logo{
    width: 100%;
    height: 100%;
    object-fit: contain;
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

.nav-drawer {
    display: none;
    position: fixed;
    left: -16rem;
    bottom: 0;
    z-index: 20;
    width: 16rem;
    background-color: colors.$charcoal600;
    opacity: 0;
    visibility: hidden;
    transition: visibility 0s linear 0.3s, left 0.3s ease-in-out, opacity 0.3s ease-in-out;

    &::after {
        content: "";
        position: absolute;
        z-index: 11;
        top: 0;
        right: 0;
        bottom: 0;
        width: 0.0625rem;
        background: linear-gradient(to bottom, transparent, colors.$charcoal500, transparent);
    }

    &.expand {
        left: 0;
        opacity: 1;
        visibility: visible;
        transition: visibility 0s linear, left 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }

    @media (max-width: 1170px) {
        display: block;
    }
}

.nav-drawer__body-cover {
    position: fixed;
    z-index: 19;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(colors.$charcoal300, 0.5);
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s linear 0.3s, opacity 0.3s ease-in-out;

    &.expand {
        transition: visibility 0s linear, opacity 0.3s ease-in-out;
        visibility: visible;
        opacity: 1;
    }
}

</style>
