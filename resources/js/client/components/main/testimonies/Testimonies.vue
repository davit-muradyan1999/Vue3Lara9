<template>
<div class="landing__testimonies">
    <h4 class="text-heading-4 landing__testimonies-heading">We believe in simple, timeless, and responsible designs.
    </h4>
    <div class="carousel landing_testimonies-carousel">
        <div class="carousel__tray-wrapper">
            <ul class="carousel__tray" style="left: 0px; column-gap: 64px;">
                <li class="carousel__item" style="width: calc(33.3333% - 42.6667px);">
                    <div class="card-quote ">
                        <blockquote class="card-quote__quote">Such beautiful dishes that I have come to refer to as my
                            shelf art! if you have open shelving these dishes are for you. They are unique.</blockquote>
                        <span class="card-quote__author">Glen, Niagara Falls, ON</span>
                    </div>
                </li>
                <li class="carousel__item" style="width: calc(33.3333% - 42.6667px);">
                    <div class="card-quote ">
                        <blockquote class="card-quote__quote">I loved these dishes from the get-go! Knew I had to have
                            them. I chose three colours and they go together beautifully.</blockquote><span
                            class="card-quote__author">Vanessa, Sherwood Park, AB</span>
                    </div>
                </li>
                <li class="carousel__item" style="width: calc(33.3333% - 42.6667px);">
                    <div class="card-quote ">
                        <blockquote class="card-quote__quote">If you've been contemplating purchasing these plates - go
                            for it! They've elevated my dining experience and make meals so much more enjoyable!
                        </blockquote><span class="card-quote__author">Tobi, Vancouver, BC</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</template>

<script setup>

</script>

<style lang="scss" scoped>
@use "../../../../../assets/styles/colors.scss";
@use "../../../../../assets/styles/typography.scss";

.landing__testimonies {
  margin-bottom: 5rem;
}

.landing__testimonies-heading {
  text-align: center;
  margin-bottom: 5rem;
}
.text-heading {
  font-family: typography.$heading;
  letter-spacing: 0.0625rem;
  line-height: 1.6em;
  font-weight: 400;
  color: colors.$charcoal100;
  margin-bottom: 2rem;
}
.text-heading-4 {
  @extend .text-heading;
  font-size: 1.25rem;
}
.carousel {
  width: 100%;
}

.carousel__tray-wrapper {
  overflow: hidden;
}

.carousel__tray {
  position: relative;
  left: 0;
  transition: left 0.5s linear;
  display: flex;
  justify-content: space-between;
  align-items: stretch;
}

.carousel__item {
  overflow: hidden;
  flex-shrink: 0;
  position: relative;
}

.carousel__pagination {
  display: flex;
  margin-top: 2rem;
  justify-content: center;
}

.carousel__page-number {
  margin: 0 0.5rem;
  display: flex;
}

.carousel__current-page-number,
.carousel__total-pages-count {
  height: 2rem;
  line-height: 2rem;
  display: block;
  text-align: center;
  font-weight: 700;
  color: colors.$charcoal300;
}

.carousel__page-number-separator {
  height: 2rem;
  line-height: 2rem;
  min-width: 1rem;
  text-align: center;
  font-weight: 700;
  color: colors.$charcoal300;
}

.carousel__prev-button,
.carousel__next-button {
  transition: opacity 0.3s ease-in-out;
  svg {
    width: 1.25rem;
    height: 1.25rem;
    path {
      fill: colors.$charcoal200;
    }
  }

  &.disable {
    pointer-events: none;
    opacity: 0.5;
  }
}

.card-quote__quote {
  &::before,
  &::after {
    content: '"';
  }

  font-family: typography.$heading;
  font-size: 1rem;
  line-height: 2em;
  text-align: center;
  font-weight: 300;
  font-size: 1rem;
  letter-spacing: 0.0625rem;
  margin-bottom: 1rem;
  color: colors.$charcoal100;
}

.card-quote__author {
  text-align: center;
  display: block;
  color: colors.$charcoal300;
}
</style>
