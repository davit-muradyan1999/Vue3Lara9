<template>
    <h1 class="text-heading-1 landing__heading">Sustainably crafted goods to elevate your everyday.</h1>
    <ul class="collage--5-piece landing__multi-link-collage">
        <li v-for="category in categories" :key="category.id" class="collage__item-wrapper">
            <Link class="link-image landing__multi-link-collage-item" :href="`/categories/${category.id}`">
                <span class="link-image__image" :style="{ backgroundImage: `url(${'storage/'+category.image ?? ''})` }"></span>
                <span class="link-image__title">
          <span class="link-image__title-text">{{ category.title[locale] }}</span>
          <img class="icon arrow-right link-image__title-icon" src="/public/client/icons/right.svg" alt="right">
        </span>
            </Link>
        </li>
    </ul>
</template>
<script setup>
import {Link, usePage} from '@inertiajs/vue3';
import {computed} from "vue";


const locale = computed(() => usePage().props.locale);
let props = defineProps({
    categories: Array
});
console.log(props.categories);
</script>

<style lang="scss" scoped>
@use "../../../../../assets/styles/colors.scss";
@use "../../../../../assets/styles/typography.scss";
@use "../../../../../assets/styles/shared.scss";
.text-heading {
  font-family: typography.$heading;
  letter-spacing: 0.0625rem;
  line-height: 1.6em;
  font-weight: 400;
  color: colors.$charcoal100;
  margin-bottom: 2rem;
}


.text-heading-1 {
  @extend .text-heading;
  font-size: 2.125rem;
}
.landing__heading {
  text-align: center;
  max-width: 50rem;
  margin: 0 auto 4rem auto;
}
$collageBreakPoint: 800px;

.landing__multi-link-collage {
  margin-bottom: 5rem;

  .collage__item-wrapper {
    &:nth-of-type(5n + 2) {
      .landing__multi-link-collage-item {
        padding-bottom: calc((100% - 1.5rem) / 2 * 1.5);

        @media (max-width: $collageBreakPoint) {
          padding-bottom: calc(100% * 1.5);
        }
      }
    }

    .link-image__title {
      @media (max-width: 500px) {
        font-size: 0.875rem;
        padding: 1rem;
      }
    }

    .link-image__image {
      @media (max-width: 500px) {
        bottom: 3.5rem;
      }
    }
  }
}

.link-image {
  display: block;
  box-sizing: border-box;
  border: 0.0625rem solid colors.$charcoal500;
  border-radius: 0.5rem;
  overflow: hidden;
  position: relative;
  width: 100%;
  padding-bottom: calc(100% * 1.5);

  &:hover {
    .link-image__image {
      transform: scale(1.05);
    }

    .link-image__title-icon {
      margin-left: 0.25rem;
    }
  }
}

.link-image__image {
  width: 100%;
  display: block;
  overflow: hidden;
  background-image: inherit;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  transition: transform 0.5s ease-in-out;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  bottom: 4.5rem;
}

.link-image__title {
  display: block;
  background-color: colors.$charcoal600;
  box-sizing: border-box;
  padding: 1.5rem 1rem;
  line-height: 1.5rem;
  font-size: 1rem;
  letter-spacing: 0.0625rem;
  position: absolute;
  font-family: typography.$heading;
  bottom: 0;
  left: 0;
  width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.link-image__title-text {
  display: inline;
  vertical-align: top;
  text-transform: capitalize;
}

.link-image__title-icon {
  display: inline;
  vertical-align: top;
  margin-left: 0.125rem;
  width: 1rem;
  height: 1rem;
  padding: 0.2rem;
  transition: margin 0.3s ease-in-out;
  path {
    fill: colors.$charcoal200;
  }
}
$breakPoint: 800px;

.collage {
  display: grid;
  width: 100%;
  column-gap: 1.5rem;
  row-gap: 1.5rem;
}

.collage--5-piece {
  @extend .collage;
  grid-template-columns: 1fr 1fr 1fr;
  grid-template-rows: 1fr 1fr;
  grid-template-areas:
    "one two two"
    "three four five";

  @media (max-width: $breakPoint) {
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 0.5fr 1fr 0.5fr;
    grid-template-areas:
      "one two"
      "three three"
      "four five";
  }

  .collage__item-wrapper {
    &:nth-of-type(5n + 1) {
      grid-area: one;
    }

    &:nth-of-type(5n + 2) {
      grid-area: two;
    }

    &:nth-of-type(5n + 3) {
      grid-area: three;
    }

    &:nth-of-type(5n + 4) {
      grid-area: four;
    }

    &:nth-of-type(5n + 5) {
      grid-area: five;
    }
  }
}

.collage--3-piece {
  @extend .collage;
  grid-template-columns: 2fr 1fr;
  grid-template-rows: 1fr 1fr;
  grid-template-areas:
    "one two"
    "one three";

  @media (max-width: $breakPoint) {
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 0.5fr;
    grid-template-areas:
      "one one"
      "two three";
  }

  .collage__item-wrapper {
    position: relative;

    &:nth-of-type(3n + 1) {
      grid-area: one;
    }

    &:nth-of-type(3n + 2) {
      grid-area: two;
    }

    &:nth-of-type(3n + 3) {
      grid-area: three;
    }
  }
}
</style>
