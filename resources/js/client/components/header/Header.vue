<template>
    <div>
      <header class="app__header">
        <div class="app-bar">
          <div class="app-bar__wrapper">
            <a class="link--plain link-icon--expandOnHover app-bar__cart" href="/react-based-shopify-craft-theme/cart">
              <img src="client/icons/bascet.svg" alt="bascet">
              <span class="badge link-icon__badge">0</span></a>
              <a aria-current="page" class="link--plain app-bar__company active" href="/react-based-shopify-craft-theme/">
                  <img class="icon logo link-icon__icon" src="client/icons/logo.svg"  alt="logo">
              </a>
            <button type="button" class="button--plain  button-icon--expandOnHover  app-bar__search">
                <img src="client/icons/search.svg" alt="search">
            </button>
            <button type="button" class="button--plain  button-icon--expandOnHover  app-bar__menu">
                <img src="client/icons/burger.svg" alt="burger">
            </button>
          </div>
        </div>
        <nav class="nav-bar">
          <menu class="menu-list--metro nav-bar__menu">
            <DropdownMenu />
            <li class="menu-list__item"><a class="link--underlineOnHover menu-list__link" href="/react-based-shopify-craft-theme/collections/glassware">Glassware</a></li>
            <li class="menu-list__item"><a class="link--underlineOnHover menu-list__link" href="/react-based-shopify-craft-theme/collections/serveware">Serveware</a></li>
            <li class="menu-list__item"><a class="link--underlineOnHover menu-list__link" href="/react-based-shopify-craft-theme/collections/flatware">Flatware</a></li>
            <li class="menu-list__item"><a class="link--underlineOnHover menu-list__link" href="/react-based-shopify-craft-theme/collections/textiles">Textiles</a></li>
            <li class="menu-list__item"><a class="link--underlineOnHover menu-list__link" href="/react-based-shopify-craft-theme/collections/bundles">Bundles</a></li>
          </menu>
        </nav>
      </header>
    </div>
</template>
<script setup>
import DropdownMenu from './DropdownMenu.vue';
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
