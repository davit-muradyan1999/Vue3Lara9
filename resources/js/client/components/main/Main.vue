<template>
            <Collage :categories="categories" />
</template>

<script setup>
import Collage from './collage/Collage.vue';

defineProps({
    categories: Array
});

</script>

<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/typography.scss";
@use "../../../../assets/styles/shared.scss";

$breakPoint: 1175px;
.source-code-link {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 6rem;
  height: 6rem;
  background-color: colors.$charcoal-200;
  mix-blend-mode: difference;
  clip-path: polygon(0 0, 0 100%, 100% 100%);
  transition: background-color 0.3s ease-in-out;
  z-index: 40;

  svg {
    position: absolute;
    bottom: 1rem;
    left: 1rem;

    path {
      fill: white;
      transition: fill 0.3s ease-in-out;
    }
  }
}



.landing__video {
  margin-bottom: 5rem;
}



.landing__single-link-collage {
  margin-bottom: 5rem;

  .collage__item-wrapper {
    &:nth-of-type(3n + 1) {
      .link-image {
        padding-bottom: calc(100% * 3 / 4);
      }
    }

    &:nth-of-type(3n + 2),
    &:nth-of-type(3n + 3) {
      span {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        border-radius: 0.5rem;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }
    }
  }
}

$infoBreakPoint: 600px;

.landing__info {
  display: flex;
  flex-flow: row wrap;
  justify-content: space-between;
  gap: 4rem;
  margin-bottom: 5rem;
}

.landing__info-item {
  width: calc((100% - 12rem) / 4);

  @media (max-width: $breakPoint) {
    width: calc((100% - 4rem) / 2);
  }

  @media (max-width: $infoBreakPoint) {
    width: 100%;
  }
}

.landing__posts-carousel {
  .card-post {
    height: 100%;
  }
}



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

.text-heading-2 {
  @extend .text-heading;
  font-size: 1.75rem;
}

</style>
