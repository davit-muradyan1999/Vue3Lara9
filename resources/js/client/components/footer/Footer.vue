<template>
    <footer class="app-footer">
        <div class="app-footer__wrapper">
            <div class="sitemap--dark app-footer__sitemap">
                <h4 class="text-heading-4 sitemap__heading">Get to know Craft</h4>
                <ul class="sitemap__list">
                    <li class="sitemap__list-item"><Link class="link--underlineOnHover sitemap__link" href="/about">About</Link></li>
                    <li class="sitemap__list-item"><Link class="link--underlineOnHover sitemap__link" href="/blogs">Blogs</Link></li>
                </ul>
            </div>
            <div class="card-info app-footer__mission"><strong class="card-info__title">Our Mission</strong>
                <p class="card-info__description">We create products that are as enjoyable as they are ethical.</p>
            </div>
        </div>
        <hr class="app-footer__separator">
        <div class="app-footer__wrapper">
            <small class="app-footer__copyright">©2025, Dvin Gold</small></div>
    </footer>
</template>

<script setup>

import { Link } from '@inertiajs/vue3';
</script>

<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/shared.scss";
@use "../../../../assets/styles/typography.scss";
.app-footer {
    background-color: colors.$charcoal100;
    color: colors.$charcoal500;
    padding: 1rem 0;
    overflow: hidden;
  }

  .app-footer__wrapper {
    @extend .wrapper;
    padding-bottom: 4rem;

    &:last-of-type {
      padding-bottom: 0;
    }
  }

  .app-footer__subscription-form {
    margin: 0 auto 4rem auto;
  }

  .app-footer__sitemap {
    width: calc((100% - 1.5rem) / 2);
    float: left;
    margin-right: 1.5rem;

    @media (max-width: 500px) {
      width: 100%;
      float: none;
      margin-left: 0;
      margin-bottom: 4rem;
      text-align: center;
    }
  }

  .app-footer__mission {
    text-align: left;
    width: calc((100% - 1.5rem) / 2);
    float: left;

    @media (max-width: 500px) {
      width: 100%;
      float: none;
      margin-left: 0;
      text-align: center;
    }
  }

  .app-footer__separator {
    border: none;
    margin: 0;
    border-bottom: 0.0625rem solid colors.$charcoal200;
  }

  .app-footer__copyright {
    display: block;
    font-size: 0.75rem;
    text-align: center;
  }

  .app-footer__credit-cards {
    margin-top: 4rem;
    margin-bottom: 1rem;
    display: flex;
    justify-content: center;
  }

  .app-footer__credit-card-item {
    margin-right: 0.5rem;
    width: 2.5rem;
    height: 2.5rem;
    position: relative;

    &:last-of-type {
      margin-right: 0;
    }

    img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: contain;
      object-position: center;
    }
  }

  .subscription-form {
    max-width: 40rem;
    text-align: center;
  }

  .subscription-form__description {
    margin-bottom: 1.5rem;
  }

  .subscription-form__wrapper {
    max-width: 25rem;
    margin: auto;
    position: relative;
  }

  .subscription-form__submit-button {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    z-index: 2;

    svg {
      width: 1.25rem;
      height: 1.25rem;
    }

    &.spinner {
      animation: spinner 1s linear 0s infinite forwards;
    }
  }

  .subscription-form__text-field {
    margin-bottom: 1rem;
  }

  .subscription-form__message {
    display: block;
    clip-path: inset(0 50% 0 50%);
    transition: clip-path 0.5s ease-in-out;
    line-height: 1.25em;
    font-size: 0.875rem;

    &.visible {
      clip-path: inset(0 0 0 0);
    }
  }

  .subscription-form--light {
    @extend .subscription-form;
  }

  .subscription-form--dark {
    @extend .subscription-form;
    color: colors.$charcoal500;

    .subscription-form__heading {
      color: colors.$charcoal500;
    }

    .subscription-form__text-field {
      border-color: colors.$charcoal300;
      background-color: transparent;

      &.focused {
        border-color: colors.$charcoal700;
      }

      &:hover {
        border-color: colors.$charcoal500;
      }

      .text-field__label {
        color: colors.$charcoal400;
      }

      .text-field__input {
        color: colors.$charcoal500;
        padding: 0 3rem 0 1rem;
      }
    }

    .subscription-form__submit-button {
      path {
        fill: colors.$charcoal300;
      }

      &:hover {
        path {
          fill: colors.$charcoal500;
        }
      }
    }
  }

  @keyframes spinner {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(180deg);
    }
  }

  .sitemap {
}

.sitemap__heading {
  margin-bottom: 1rem;
  font-size: 1rem;
  letter-spacing: 0.0625rem;
}

.sitemap__list {
}

.sitemap__list-item {
  margin-bottom: 0.5rem;

  &:last-of-type {
    margin-bottom: 0;
  }
}

.sitemap__link {
  white-space: nowrap;
}

.sitemap--light {
  @extend .sitemap;
}

.sitemap--dark {
  @extend .sitemap;

  .sitemap__heading {
    color: colors.$charcoal500;
  }

  .sitemap__link {
    color: colors.$charcoal300;
    transition: color 0.3s ease-in-out;

    &:hover {
      color: colors.$charcoal500;
    }
  }
}

.card-info {
    overflow: hidden;
    text-align: center;
  }

  .card-info__image {
    display: block;
    margin: auto;
    width: 6rem;
    height: 6rem;
    object-fit: contain;
    object-position: center;
    margin-bottom: 1.5rem;
  }

  .card-info__icon {
    width: 2.5rem;
    height: 2.5rem;
    margin-bottom: 1.5rem;

    path {
      fill: colors.$charcoal400;
    }
  }

  .card-info__title {
    font-family: typography.$heading;
    letter-spacing: 0.0625rem;
    margin-bottom: 1rem;
    display: block;
  }

  .card-info__description {
    color: colors.$charcoal300;
  }
</style>
