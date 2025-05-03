<template>
    <RequestPrice v-if="showModal" :isOpen="showModal" :productId="productId" @close="showModal = false" />
    <div class="product-template">
        <div class="product-template__info-gallery-wrapper">
            <!-- Галерея изображений -->
            <div
                v-if="product.images && product.images.length > 0"
                class="collage-product--6-piece product-template__gallery"
            >
                <div
                    v-for="(image, index) in product.images"
                    :key="index"
                    class="collage-product__item-wrapper"
                >
                    <button
                        type="button"
                        @click="openZoom(image)"
                        class="button--plain button-icon--expandOnHover collage-product__item-wrapper__zoom-button"
                    >
                        <svg
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 1024 1024"
                            class="icon zoom-in button-icon__icon"
                        >
                            <path
                                class="icon__path"
                                d="M684.416 676.523c-1.451 1.109-2.859 2.347-4.224 3.712s-2.56 2.731-3.712 4.224c-53.675 51.755-126.677 83.541-207.147 83.541-82.475 0-157.099-33.365-211.2-87.467s-87.467-128.725-87.467-211.2 33.365-157.099 87.467-211.2 128.725-87.467 211.2-87.467 157.099 33.365 211.2 87.467 87.467 128.725 87.467 211.2c0 80.469-31.787 153.472-83.584 207.189zM926.165 865.835l-156.8-156.8c52.523-65.707 83.968-149.035 83.968-239.701 0-106.027-43.008-202.069-112.469-271.531s-165.504-112.469-271.531-112.469-202.069 43.008-271.531 112.469-112.469 165.504-112.469 271.531 43.008 202.069 112.469 271.531 165.504 112.469 271.531 112.469c90.667 0 173.995-31.445 239.701-83.968l156.8 156.8c16.683 16.683 43.691 16.683 60.331 0s16.683-43.691 0-60.331zM341.333 512h85.333v85.333c0 23.552 19.115 42.667 42.667 42.667s42.667-19.115 42.667-42.667v-85.333h85.333c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-85.333v-85.333c0-23.552-19.115-42.667-42.667-42.667s-42.667 19.115-42.667 42.667v85.333h-85.333c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z"
                            ></path>
                        </svg>
                    </button>
                    <img :src="getImageUrl(image)" alt="Product image" class="product-image" />
                </div>
            </div>

            <!-- Модальное окно для зума -->
            <div
                :class="{ 'collage-product__zoom-view': true, 'visible': isZoomOpen }"
            >
                <button
                    type="button"
                    @click="closeZoom"
                    class="button--plain button-icon--expandOnHover collage-product__zoom-view__close-button"
                >
                    <svg
                        version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 1024 1024"
                        class="icon cross button-icon__icon"
                    >
                        <path
                            class="icon__path"
                            d="M225.835 286.165l225.835 225.835-225.835 225.835c-16.683 16.683-16.683 43.691 0 60.331s43.691 16.683 60.331 0l225.835-225.835 225.835 225.835c16.683 16.683 43.691 16.683 60.331 0s16.683-43.691 0-60.331l-225.835-225.835 225.835-225.835c16.683-16.683 16.683-43.691 0-60.331s-43.691-16.683-60.331 0l-225.835 225.835-225.835-225.835c-16.683-16.683-43.691-16.683-60.331 0s-16.683 43.691 0 60.331z"
                        ></path>
                    </svg>
                </button>
                <div class="collage-product__zoom-view__wrapper">
                    <img
                        v-if="selectedImage"
                        :src="getImageUrl(selectedImage)"
                        alt="Zoomed product image"
                    />
                </div>
            </div>
            <div class="product-template__info">
                <div class="product-template__info__wrapper">
                    <hgroup class="product-template__info__heading-group"><h1 class="text-heading-1 heading">{{ product.title[locale] }}</h1></hgroup>
                    <div class="product-template__info__cart">
                        <button type="button" @click="showModal = true"
                                class="button--outlined product-template__info__cart__add">Request a Price
                        </button>
                    </div>
                    <div class="product-template__info__content-wrapper">
                        <div class="content">
                            <p v-html="product.description[locale]"></p>
                        </div>
                        <template v-if="is_auth_check">
                            <div class="content">
                                <p><strong>Title:</strong> {{ product.auth_check.title }}</p>
                                <p><strong>Item:</strong> {{ product.auth_check.item }}</p>
                                <p><strong>Gold:</strong> {{ product.auth_check.gold }}</p>
                                <p><strong>Silver:</strong> {{ product.auth_check.silver }}</p>
                                <p><strong>Stone:</strong> {{ product.auth_check.stone }}</p>
                                <p><strong>Other Materials:</strong> {{ product.auth_check.other_materials }}</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref, watch} from "vue";
import {Link, router, usePage} from "@inertiajs/vue3";
import RequestPrice from "@/client/components/products/RequestPrice.vue";


const showModal = ref(false)
const isZoomOpen = ref(false);
const selectedImage = ref(null);
const locale = computed(() => usePage().props.locale);

const props = defineProps({
    product: Object,
    is_auth_check: Object
});
const productId = props.product.id;
const getImageUrl = (imagePath) => {
    return `/storage/${imagePath}`;
};

const openZoom = (image) => {
    selectedImage.value = image;
    isZoomOpen.value = true;
};

const closeZoom = () => {
    isZoomOpen.value = false;
    selectedImage.value = null;
};
</script>
<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/typography.scss";
@use "../../../../assets/styles/shared.scss";

$breakPoint: 900px;

$breakPoint2: 450px;

.product-template__info-gallery-wrapper {
    display: flex;
    gap: 4rem;
    flex-flow: row nowrap;

    @media (max-width: $breakPoint) {
        display: block;
    }
}

.product-template__gallery--carousel {
    display: block;
    margin-bottom: 4rem;

    .carousel__item {
        border-radius: 0.5rem;
        overflow: hidden;

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    }
}

.product-template__info {
    width: calc((100% - 4rem) * 0.4);
    order: 2;
    position: relative;

    @media (max-width: $breakPoint) {
        width: 100%;
    }
}

.product-template__info__wrapper {
    position: sticky;
    top: 2rem;
}

.product-template__info__heading-group {
    margin-bottom: 2rem;

    .caption,
    .subtitle {
        display: block;
        font-weight: 400;
        font-size: 1rem;
        letter-spacing: 0.0625rem;
        line-height: 1em;
        color: colors.$charcoal300;
    }

    .caption {
        text-transform: uppercase;
        font-size: 0.75rem;
        margin-bottom: 0.25rem;
        letter-spacing: 0.125rem;
    }

    .heading {
        margin-bottom: 1rem;
    }
}

.product-template__info__price {
    font-size: 1.125rem;
    margin-bottom: 2rem;
    line-height: 1.5rem;

    &.sale {
        vertical-align: middle;

        &::after {
            display: inline-block;
            content: "Sale";
            margin-left: 1rem;
            font-size: 0.75rem;
            background-color: colors.$charcoal200;
            color: colors.$charcoal600;
            border-radius: 0.25rem;
            height: 1.5rem;
            line-height: 1.6rem;
            padding: 0 1rem;
            top: -0.0625rem;
            position: relative;
        }
    }
}

.product-template__info__cart {
    margin-bottom: 2rem;

    .product-template__info__cart__add,
    .product-template__info__cart__buy {
        display: block;
        width: 100%;
    }

    .product-template__info__cart__add,
    .product-template__info__cart__qty {
        margin-bottom: 1rem;
    }

    .product-template__info__cart__qty-label {
        font-size: 0.875rem;
        display: block;
        line-height: 1em;
        margin-bottom: 0.5rem;
        color: colors.$charcoal200;
    }
}

.product-template__gallery {
    width: calc((100% - 4rem) * 0.6);
}

.product-template__info__content-wrapper {
    .notice {
        font-style: italic;
        font-size: 1.125rem;
        margin-bottom: 2rem;
        color: colors.$charcoal300;

        a {
            text-decoration: underline;
            transition: color 0.3s ease-in-out;

            &:hover {
                color: colors.$charcoal100;
            }
        }
    }

    .content {
        color: colors.$charcoal200;

        p {
            margin-bottom: 2rem;
            word-break: break-word;
        }

        ul {
            margin-bottom: 2rem;

            li {
                position: relative;
                box-sizing: border-box;
                padding-left: 1.75rem;
                margin-bottom: 0.5rem;

                &::before {
                    content: "";
                    width: 0.5rem;
                    height: 0.5rem;
                    position: absolute;
                    border-radius: 50%;
                    left: 0.5rem;
                    top: 0.46rem;
                    background-color: colors.$charcoal400;
                }
            }
        }
    }
}

.product-template__spec {
    border-top: 0.0625rem solid colors.$charcoal500;
    padding: 1rem 0;

    &:last-of-type {
        margin-bottom: 0;
        border-bottom: 0.0625rem solid colors.$charcoal500;
    }
}

.product-template__banner {
    margin-top: 6rem;
}

.product-template__related-products {
    margin-top: 6rem;
}

.product-template__related-products__list {
    display: flex;
    gap: 1.5rem;
    flex-flow: row nowrap;
    width: 100%;
    justify-content: center;
    align-items: stretch;

    @media (max-width: $breakPoint) {
        flex-flow: row wrap;
    }
}

.product-template__related-product-wrapper {
    flex-grow: 1;
    flex-basis: 0;
    min-width: 0;

    a {
        height: 100%;
    }
    @media (max-width: $breakPoint) {
        min-width: calc((100% - 3rem) / 2);
    }

    @media (max-width: $breakPoint2) {
        min-width: 100%;
    }
}
.collage-product {
    display: grid;
    width: 100%;
    column-gap: 1.5rem;
    row-gap: 1.5rem;
}

.collage-product__item-wrapper {
    overflow: hidden;
    position: relative;
    width: 100%;
    padding-bottom: calc(100% * 4 / 3);
    border-radius: 0.5rem;

    &:hover {
        .collage-product__item-wrapper__zoom-button {
            opacity: 1;
        }
    }

    img {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 1;
    }
}

.collage-product__item-wrapper__zoom-button {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background-color: colors.$charcoal600;
    border: 0.0625rem solid colors.$charcoal400;
    z-index: 2;
    border-radius: 50%;
    width: 2rem;
    height: 2rem;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;

    svg {
        width: 1rem;
        height: 1rem;
    }
}

.collage-product__zoom-view {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 25;
    background-color: colors.$charcoal-300;
    box-sizing: border-box;
    padding: 5rem;
    visibility: hidden;
    clip-path: inset(50% 0 50% 0);
    opacity: 0;
    transition: visibility 0s linear 0.5s, clip-path 0.5s ease-in-out, opacity 0.5s ease-in-out;
    @media (max-width: $breakPoint) {
        padding: 3rem;
    }

    @media (max-width: $breakPoint2) {
        padding: 1rem;
    }
    &.visible {
        transition: visibility 0s linear, clip-path 0.5s ease-in-out, opacity 0.5s ease-in-out;
        opacity: 1;
        visibility: visible;
        clip-path: inset(0 0 0 0);
    }
}

.collage-product__zoom-view__wrapper {
    overflow: auto;
    max-height: 100%;
    border-radius: 0.5rem;
    &::-webkit-scrollbar {
        width: 0.5rem;
    }

    &::-webkit-scrollbar-track {
        background-color: colors.$charcoal500;
    }

    &::-webkit-scrollbar-thumb {
        background-color: colors.$charcoal400;
    }
    img {
        width: 100%;
        height: auto;
    }
}

.collage-product__zoom-view__close-button {
    position: fixed;
    top: 1rem;
    right: 1rem;
    background-color: colors.$charcoal600;
    width: 2.5rem;
    height: 2.5rem;
    z-index: 26;
    border-radius: 0.5rem;
}

.collage-product--6-piece {
    @extend .collage-product;

    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-template-areas:
    "one one"
    "one one"
    "two three"
    "four five"
    "six six"
    "six six";

    .collage-product__item-wrapper {
        &:nth-of-type(6n + 1) {
            grid-area: one;
        }

        &:nth-of-type(6n + 2) {
            grid-area: two;
        }

        &:nth-of-type(6n + 3) {
            grid-area: three;
        }

        &:nth-of-type(6n + 4) {
            grid-area: four;
        }

        &:nth-of-type(6n + 5) {
            grid-area: five;
        }

        &:nth-of-type(6n + 6) {
            grid-area: six;
        }
    }
}

.collage-product--5-piece {
    @extend .collage-product;

    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-template-areas:
    "one one"
    "one one"
    "two three"
    "four five";

    .collage-product__item-wrapper {
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

.collage-product--4-piece {
    @extend .collage-product;

    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-template-areas:
    "one one"
    "one one"
    "two three"
    "four four"
    "four four";

    .collage-product__item-wrapper {
        &:nth-of-type(4n + 1) {
            grid-area: one;
        }

        &:nth-of-type(4n + 2) {
            grid-area: two;
        }

        &:nth-of-type(4n + 3) {
            grid-area: three;
        }

        &:nth-of-type(4n + 4) {
            grid-area: four;
        }
    }
}

.collage-product--3-piece {
    @extend .collage-product;

    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-template-areas:
    "one one"
    "one one"
    "two three";

    .collage-product__item-wrapper {
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

.collage-product--2-piece {
    @extend .collage-product;

    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-template-areas:
    "one one"
    "one one"
    "two two"
    "two two";

    .collage-product__item-wrapper {
        &:nth-of-type(2n + 1) {
            grid-area: one;
        }

        &:nth-of-type(2n + 2) {
            grid-area: two;
        }
    }
}

.collage-product--1-piece {
    @extend .collage-product;

    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-template-areas:
    "one one"
    "one one";

    .collage-product__item-wrapper {
        grid-area: one;
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

    @media (max-width: $breakPoint) {
        font-size: 1.125rem;
    }
}

.text-heading-2 {
    @extend .text-heading;
    font-size: 1.75rem;
}

.text-heading-3 {
    @extend .text-heading;
    font-size: 1.5rem;
}

.text-heading-4 {
    @extend .text-heading;
    font-size: 1.25rem;
}
.button-quantity {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    max-width: 9rem;
    overflow: hidden;
    border-radius: 0.5rem;
    border: 0.0625rem solid colors.$charcoal300;
    box-sizing: border-box;
}

.button-quantity__minus,
.button-quantity__plus {
    width: 3rem;
    height: 3rem;

    svg {
        width: 1rem;
        height: 1rem;
    }
}

.button-quantity__quantity {
    width: 3rem;
    height: 3rem;
    line-height: 3rem;
    text-align: center;
}

.button-quantity.disable {
    border-color: colors.$charcoal400;
    .button-quantity__quantity {
        color: colors.$charcoal300;
    }
}

</style>
