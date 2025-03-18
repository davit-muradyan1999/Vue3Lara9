<template>
    <div>
        <h1 v-if="private">Private Product</h1>
        <h1 v-else>Product Category: {{ category.title }}</h1>
        <div class="filters flex items-center justify-between mb-6">
            <div class="flex items-center justify-self-start gap-4">
                <p>Filter:</p>
                <div class="w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <select
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                            <option value="">Availability</option>
                            <option value="bucharest">In stock</option>
                            <option value="london">Out of stock</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                             stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-self-start gap-4">
                <p class="w-full">Sort by:</p>
                <div class="w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <select
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                            <option value="best">Best selling</option>
                            <option value="a_z">Alphabetically, A-Z</option>
                            <option value="z_a">Alphabetically, Z-A</option>
                            <option value="price_low">Price, low to high</option>
                            <option value="price_high">Price, high to low</option>
                            <option value="asc">Date, old to new</option>
                            <option value="desc">Date, new to old</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                             stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="paginator list-product__products--three-column">
            <div class="paginator__wrapper">
                <a v-for="product in products" :key="product.id" class="link-product--imageExpandOnHover list-product__products__item" href="/react-based-shopify-craft-theme/products/the-napkins">
                    <span class="link-product__image-wrapper">
                        <img class="link-product__image" :src="'storage/'+product.image[0]" :alt="product.title">
                    </span>
                    <span class="link-product__title">{{ product.title }}</span>
                    <span class="text-price link-product__price">
                        <span>{{ product.price }}$</span>
                    </span>
                </a>
            </div>
        </div>
<!--        <ul>-->
<!--            <li v-for="product in products" :key="product.id">-->
<!--                <h3>{{ product.title }}</h3>-->
<!--                <p v-html="product.description"></p>-->
<!--                <p>Price: {{ product.price }}$</p>-->
<!--            </li>-->
<!--        </ul>-->
    </div>
</template>

<script setup>
import {defineProps} from 'vue';

defineProps({
    private: Boolean,
    category: Object,
    products: Array
});
</script>
<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/typography.scss";
@use "../../../../assets/styles/shared.scss";
.filters {
    margin-bottom: 1.5rem;
}
.list-product__products {
    .paginator__wrapper {
        display: flex;
        gap: 1.5rem;
        flex-flow: row wrap;
        justify-content: flex-start;
        align-items: stretch;
    }
}

.list-product__products__item {
    width: calc((100% - 4.5rem) / 4);
    overflow: hidden;

    @media (max-width: 900px) {
        width: calc((100% - 3rem) / 3);
    }

    @media (max-width: 750px) {
        width: calc((100% - 1.5rem) / 2);
    }

    @media (max-width: 500px) {
        width: 100%;
    }
}

.list-product__products--three-column {
    @extend .list-product__products;

    .list-product__products__item {
        width: calc((100% - 3rem) / 3);
        overflow: hidden;

        @media (max-width: 750px) {
            width: calc((100% - 1.5rem) / 2);
        }

        @media (max-width: 500px) {
            width: 100%;
        }
    }
}

.link-product {
    overflow: hidden;
    display: block;
    box-sizing: border-box;
    border: 0.0625rem solid colors.$charcoal500;
    border-radius: 0.5rem;

    &:hover {
        .link-product__title {
            text-decoration: underline;
        }
    }
}

.link-product__image-wrapper {
    display: block;
    width: 100%;
    padding-bottom: calc(100% * 4 / 3);
    overflow: hidden;
    position: relative;
}

.link-product__image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;

    &:nth-of-type(2n + 1) {
        z-index: 2;
    }

    &:nth-of-type(2n + 2) {
        z-index: 1;
    }
}

.link-product__tag {
    position: absolute;
    z-index: 3;
    bottom: 1rem;
    left: 1rem;
    height: 1.5rem;
    line-height: 1.5rem;
    padding: 0.125rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    color: colors.$charcoal500;
    background-color: colors.$charcoal200;
}

.link-product__sale-tag {
    @extend .link-product__tag;
}

.link-product__sold-out-tag {
    @extend .link-product__tag;
    background-color: colors.$charcoal100;
    color: white;
}

.link-product__title {
    display: block;
    font-family: typography.$heading;
    font-size: 0.875rem;
    letter-spacing: 0.0625rem;
    padding: 1rem 1.5rem 0.5rem 1.5rem;
}

.link-product__price {
    display: block;
    padding: 0.5rem 1.5rem 1rem 1.5rem;
}

.link-product--imageExpandOnHover {
    @extend .link-product;

    .link-product__image {
        transition: transform 0.5s ease-in-out;
    }

    &:hover {
        .link-product__image {
            transform: scale(1.05);
        }
    }
}

</style>
